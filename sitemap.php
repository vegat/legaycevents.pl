<?php
require_once __DIR__ . '/seo.php';
header('Content-Type: application/xml; charset=UTF-8');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
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
    echo "  </url>\n";
}
echo '</urlset>' . "\n";
