<?php
<<<<<<< HEAD
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
=======
header("Content-Type: application/xml; charset=utf-8");
$host = "https://" . $_SERVER['HTTP_HOST'];

$static_pages = [
    '', // strona główna
    '/oferta',
    '/oferta_animacje',
    '/oferta_koncerty',
    '/oferta_rental',
    '/oferta_technika',
    '/oferta_wydarzenia',
    '/oferta_zamki',
    '/kontakt',
    '/galeria',
    '/blog',
    '/wspolpracujemy'
];

$posts_json = __DIR__ . '/data/posts.json';
$posts = file_exists($posts_json) ? json_decode(file_get_contents($posts_json), true) : [];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

// Static pages
foreach ($static_pages as $page) {
    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($host . $page) . "</loc>\n";
    echo "    <changefreq>weekly</changefreq>\n";
    echo "    <priority>" . ($page === '' ? '1.0' : '0.8') . "</priority>\n";
    echo "  </url>\n";
}

// Blog posts
if (is_array($posts)) {
    foreach ($posts as $post) {
        if (!empty($post['slug'])) {
            $date = !empty($post['date']) ? date('c', strtotime($post['date'])) : date('c');
            echo "  <url>\n";
            echo "    <loc>" . htmlspecialchars($host . '/post?slug=' . $post['slug']) . "</loc>\n";
            echo "    <lastmod>" . $date . "</lastmod>\n";
            echo "    <changefreq>monthly</changefreq>\n";
            echo "    <priority>0.7</priority>\n";
            echo "  </url>\n";
        }
    }
}

echo '</urlset>';
?>
>>>>>>> 1dcba791b9cf01312c8709c84e4215fd9a061e88
