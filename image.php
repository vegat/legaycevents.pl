<?php
/**
 * Dynamic Image Resizer, Cropper and Cacher for LegacyEvents
 * 
 * Supports fallbacks: Imagick -> GD -> FFMPEG -> Original Image
 * Usage: image.php?src=EventPhotos/image.jpg&w=800&h=600&crop=1
 */

$assetsDir = __DIR__ . '/assets';
$cacheDir = __DIR__ . '/cache';

if (!is_dir($cacheDir)) {
    @mkdir($cacheDir, 0777, true);
}

$maxWidth = 3840;
$maxHeight = 2160;

$src = isset($_GET['src']) ? trim($_GET['src']) : '';
$width = isset($_GET['w']) ? (int) $_GET['w'] : 0;
$height = isset($_GET['h']) ? (int) $_GET['h'] : 0;
$crop = isset($_GET['crop']) && $_GET['crop'] == '1';

if (empty($src) || strpos($src, '..') !== false) {
    header("HTTP/1.0 400 Bad Request");
    die("Invalid request");
}

$sourcePath = $assetsDir . '/' . ltrim($src, '/');

if (!file_exists($sourcePath) || !is_file($sourcePath)) {
    header("HTTP/1.0 404 Not Found");
    die("Image not found: " . htmlspecialchars($src));
}

$width = min($width, $maxWidth);
$height = min($height, $maxHeight);

$imageInfo = @getimagesize($sourcePath);
if (!$imageInfo) {
    header("HTTP/1.0 415 Unsupported Media Type");
    die("Unsupported image type");
}
list($origWidth, $origHeight, $imageType) = $imageInfo;

if ($width <= 0 && $height <= 0) {
    $width = $origWidth;
    $height = $origHeight;
}

if ($width > 0 && $height <= 0) {
    $height = max(1, round($width * ($origHeight / $origWidth)));
} elseif ($height > 0 && $width <= 0) {
    $width = max(1, round($height * ($origWidth / $origHeight)));
}

$fileModificationTime = filemtime($sourcePath);
$cacheKey = md5($src . $width . $height . ($crop ? '1' : '0') . $fileModificationTime);

$cacheExtension = image_type_to_extension($imageType, false);
if ($cacheExtension === 'jpeg')
    $cacheExtension = 'jpg';
$cacheFile = $cacheDir . '/' . $cacheKey . '.' . $cacheExtension;

$expiry = 60 * 60 * 24 * 30; // 30 days
header("Cache-Control: public, max-age=" . $expiry);
header("Expires: " . gmdate("D, d M Y H:i:s", time() + $expiry) . " GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s", $fileModificationTime) . " GMT");
header("Content-Type: " . $imageInfo['mime']);

if (file_exists($cacheFile)) {
    readfile($cacheFile);
    exit;
}

// Check processing capabilities
$processed = false;

// 1. Try Imagick
if (!$processed && extension_loaded('imagick')) {
    try {
        $image = new Imagick($sourcePath);
        if ($crop) {
            $image->cropThumbnailImage($width, $height);
        } else {
            $image->thumbnailImage($width, $height, true);
        }
        $image->writeImage($cacheFile);
        $image->clear();
        $image->destroy();
        $processed = file_exists($cacheFile);
    } catch (Exception $e) {
        $processed = false;
    }
}

// 2. Try GD
if (!$processed && extension_loaded('gd')) {
    $sourceImage = null;
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $sourceImage = @imagecreatefromjpeg($sourcePath);
            break;
        case IMAGETYPE_PNG:
            $sourceImage = @imagecreatefrompng($sourcePath);
            break;
        case IMAGETYPE_WEBP:
            $sourceImage = @imagecreatefromwebp($sourcePath);
            break;
        case IMAGETYPE_GIF:
            $sourceImage = @imagecreatefromgif($sourcePath);
            break;
    }

    if ($sourceImage !== false && $sourceImage !== null) {
        $targetImage = imagecreatetruecolor($width, $height);

        // Handle transparency
        if ($imageType == IMAGETYPE_PNG || $imageType == IMAGETYPE_WEBP) {
            imagealphablending($targetImage, false);
            imagesavealpha($targetImage, true);
            $transparent = imagecolorallocatealpha($targetImage, 255, 255, 255, 127);
            imagefilledrectangle($targetImage, 0, 0, $width, $height, $transparent);
        }

        if ($crop) {
            $originalAspect = $origWidth / $origHeight;
            $targetAspect = $width / $height;
            if ($originalAspect >= $targetAspect) {
                $newHeight = $height;
                $newWidth = $origWidth / ($origHeight / $height);
            } else {
                $newWidth = $width;
                $newHeight = $origHeight / ($origWidth / $width);
            }
            $x = 0 - ($newWidth - $width) / 2;
            $y = 0 - ($newHeight - $height) / 2;
            imagecopyresampled($targetImage, $sourceImage, $x, $y, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
        } else {
            imagecopyresampled($targetImage, $sourceImage, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);
        }

        switch ($imageType) {
            case IMAGETYPE_JPEG:
                imagejpeg($targetImage, $cacheFile, 90);
                break;
            case IMAGETYPE_PNG:
                imagepng($targetImage, $cacheFile, 9);
                break;
            case IMAGETYPE_WEBP:
                imagewebp($targetImage, $cacheFile, 90);
                break;
            case IMAGETYPE_GIF:
                imagegif($targetImage, $cacheFile);
                break;
        }

        imagedestroy($sourceImage);
        imagedestroy($targetImage);
        $processed = file_exists($cacheFile);
    }
}

// 3. Try FFMPEG if exec is enabled
if (!$processed && is_callable('exec') && false === stripos(ini_get('disable_functions'), 'exec')) {
    if ($crop) {
        $vf = "scale={$width}:{$height}:force_original_aspect_ratio=increase,crop={$width}:{$height}";
    } else {
        $vf = "scale={$width}:{$height}:force_original_aspect_ratio=decrease";
    }

    $cmd = sprintf(
        'ffmpeg -v error -y -i %s -vf %s -frames:v 1 -q:v 2 %s 2>&1',
        escapeshellarg($sourcePath),
        escapeshellarg($vf),
        escapeshellarg($cacheFile)
    );

    @exec($cmd, $output, $returnCode);
    $processed = ($returnCode === 0 && file_exists($cacheFile));
}

// 4. Fallback: serve original if processing failed
if ($processed && file_exists($cacheFile)) {
    readfile($cacheFile);
} else {
    // Return original ignoring sizing to prevent breaking images
    readfile($sourcePath);
}
