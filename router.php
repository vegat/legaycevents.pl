<?php
// router.php
// This is a router script for the built-in PHP development server (`php -S`).
// It mimics the behavior of .htaccess for extensionless URLs.

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Serve static files directly
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|svg|webp|ttf|woff|woff2|eot|ico)$/', $path)) {
    return false;
}

// Redirect root to index.php
if ($path === '/' || $path === '') {
    require __DIR__ . '/index.php';
    exit;
}

// Route extensionless URLs to their .php equivalents
$file = __DIR__ . $path . '.php';
if (file_exists($file)) {
    require $file;
    exit;
}

// Proceed to index.php or show 404 depending on existence
if (file_exists(__DIR__ . $path)) {
    return false;
}

// Default 404 (optional)
http_response_code(404);
echo "404 Not Found";
