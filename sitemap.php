<?php
require_once __DIR__ . '/seo.php';
header('Content-Type: application/xml; charset=UTF-8');

$posts_json = __DIR__ . '/data/posts.json';
$posts = file_exists($posts_json) ? json_decode(file_get_contents($posts_json), true) : [];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

// Strony statyczne
foreach ($seo_pages as $key => $page) {
    if (!empty($page['noindex'])) {
        continue;
    }
    $file = __DIR__ . '/' . $key . '.php';
    echo "  <url>\n";
    echo '    <loc>' . htmlspecialchars($site_url . $page['path']) . "</loc>\n";
    if (file_exists($file)) {
        echo '    <lastmod>' . date('Y-m-d', filemtime($file)) . "</lastmod>\n";
    }
    echo "    <priority>" . ($key === 'index' ? '1.0' : '0.8') . "</priority>\n";
    echo "  </url>\n";
}

// Wpisy na blogu
if (is_array($posts)) {
    foreach ($posts as $post) {
        if (!empty($post['slug'])) {
            echo "  <url>\n";
            echo '    <loc>' . htmlspecialchars($site_url . '/post?slug=' . urlencode($post['slug'])) . "</loc>\n";
            if (!empty($post['date']) && strtotime($post['date'])) {
                echo '    <lastmod>' . date('Y-m-d', strtotime($post['date'])) . "</lastmod>\n";
            }
            echo "    <priority>0.7</priority>\n";
            echo "  </url>\n";
        }
    }
}

echo '</urlset>' . "\n";
