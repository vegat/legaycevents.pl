<?php
$posts_json = __DIR__ . '/data/posts.json';
$posts = file_exists($posts_json) ? json_decode(file_get_contents($posts_json), true) : [];
if (!is_array($posts)) $posts = [];

$slug = $_GET['slug'] ?? '';
$post = null;
foreach ($posts as $p) {
    if ($p['slug'] === $slug) {
        $post = $p;
        break;
    }
}

if (!$post) {
    http_response_code(404);
    echo "Nie znaleziono posta.";
    exit;
}

$seo_title = htmlspecialchars($post['title']) . " - LegacyEvents Blog";
$seo_description = htmlspecialchars($post['excerpt']);
$current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Wygenerowanie obrazka og:image
$og_image = "https://$_SERVER[HTTP_HOST]/assets/Logo/legacyevents_transparent.png";
if (!empty($post['image'])) {
    $og_image = "https://$_SERVER[HTTP_HOST]/" . ltrim($post['image'], '/');
}

// GEO tags + OpenGraph + Schema.org
ob_start(); ?>
    <meta property="og:title" content="<?= $seo_title ?>">
    <meta property="og:description" content="<?= $seo_description ?>">
    <meta property="og:image" content="<?= $og_image ?>">
    <meta property="og:url" content="<?= $current_url ?>">
    <meta property="og:type" content="article">
    
    <!-- GEO Tags for Bolków, Dolnośląskie -->
    <meta name="geo.region" content="PL-DS" />
    <meta name="geo.placename" content="Bolków" />
    <meta name="geo.position" content="50.92;16.10" />
    <meta name="ICBM" content="50.92, 16.10" />
    
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "BlogPosting",
          "headline": "<?= htmlspecialchars($post['title']) ?>",
          "image": "<?= $og_image ?>",
          "datePublished": "<?= date('c', strtotime($post['date'])) ?>",
          "description": "<?= $seo_description ?>",
          "author": {
            "@type": "Organization",
            "name": "LegacyEvents"
          }
        },
        {
          "@type": "LocalBusiness",
          "name": "LegacyEvents",
          "image": "https://<?= $_SERVER['HTTP_HOST'] ?>/assets/Logo/legacyevents_transparent.png",
          "address": {
            "@type": "PostalAddress",
            "addressLocality": "Bolków",
            "addressRegion": "Dolnośląskie",
            "addressCountry": "PL"
          },
          "geo": {
            "@type": "GeoCoordinates",
            "latitude": 50.92,
            "longitude": 16.10
          },
          "telephone": "780 752 938"
        }
      ]
    }
    </script>
<?php
$seo_tags = ob_get_clean();

require_once 'header.php'; 
?>

<main class="page-wrapper">
    <section class="subpage-hero" style="padding-bottom: 20px;">
        <h1 class="subpage-title"><?= htmlspecialchars($post['title']) ?></h1>
        <p class="subpage-subtitle" style="font-size: 0.9rem; color: var(--primary-color);">Data publikacji: <?= date('d.m.Y', strtotime($post['date'])) ?></p>
    </section>

    <section class="content-section" style="max-width: 800px; margin: 0 auto; padding: 20px;">
        <article style="background: var(--card-bg); border-radius: 12px; overflow: hidden; padding: 30px; border: 1px solid var(--border-color);">
            <?php if (!empty($post['image'])): ?>
                <div style="margin-bottom: 30px; border-radius: 8px; overflow: hidden;">
                    <img src="<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" style="width: 100%; height: auto; display: block;">
                </div>
            <?php endif; ?>
            
            <div class="blog-content" style="font-size: 1.1rem; line-height: 1.8; color: #eee;">
                <?= $post['content'] ?> <!-- Treść HTML zapisana z edytora Quill -->
            </div>
        </article>
        
        <div style="margin-top: 50px; text-align: center;">
            <a href="blog" class="cta-button secondary">Wróć do listy wpisów</a>
        </div>
    </section>
</main>

<style>
.blog-content h2, .blog-content h3 { color: #fff; font-family: var(--font-heading); margin-top: 30px; }
.blog-content img { max-width: 100%; height: auto; border-radius: 8px; margin: 20px 0; }
.blog-content a { color: var(--primary-color); text-decoration: underline; }
.blog-content blockquote { border-left: 4px solid var(--primary-color); padding-left: 20px; color: #bbb; font-style: italic; margin: 20px 0;}
.blog-content p { margin-bottom: 20px; }
</style>

<?php require_once 'footer.php'; ?>
