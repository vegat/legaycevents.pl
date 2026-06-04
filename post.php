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

$geo_placename = !empty($post['geo_placename']) ? htmlspecialchars($post['geo_placename']) : 'Bolków';
$geo_position_str = !empty($post['geo_position']) ? htmlspecialchars($post['geo_position']) : '50.92, 16.10';
$geo_position_parts = array_map('trim', explode(',', $geo_position_str));
$geo_lat = $geo_position_parts[0] ?? '50.92';
$geo_lon = $geo_position_parts[1] ?? '16.10';

// Schema.org BlogPosting
ob_start(); ?>
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
            "addressLocality": "<?= htmlspecialchars($geo_placename) ?>",
            "addressRegion": "Dolnośląskie",
            "addressCountry": "PL"
          },
          "geo": {
            "@type": "GeoCoordinates",
            "latitude": <?= floatval($geo_lat) ?>,
            "longitude": <?= floatval($geo_lon) ?>
          },
          "telephone": "780 752 938"
        }
      ]
    }
    </script>
<?php
$seo_schema = ob_get_clean();

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
            
            <?php if (!empty($post['gallery'])): ?>
                <div style="margin-top: 50px; padding-top: 30px; border-top: 1px solid var(--border-color);">
                    <h3 style="font-family: var(--font-heading); color: #fff; margin-bottom: 20px; font-size: 1.5rem;">Galeria zdjęć</h3>
                    <div class="post-gallery">
                        <?php foreach ($post['gallery'] as $index => $g_img): ?>
                            <div class="gallery-img-wrapper" onclick="openLightbox(<?= $index ?>)">
                                <img src="<?= htmlspecialchars($g_img) ?>" alt="Zdjęcie w galerii">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
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

/* Galeria */
.post-gallery { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 15px; }
.gallery-img-wrapper { aspect-ratio: 1; overflow: hidden; border-radius: 8px; cursor: pointer; border: 1px solid transparent; transition: all 0.3s;}
.gallery-img-wrapper:hover { transform: scale(1.03); border-color: var(--primary-color); }
.gallery-img-wrapper img { width: 100%; height: 100%; object-fit: cover; }

/* Lightbox */
.lightbox { display: none; position: fixed; z-index: 9999; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); align-items: center; justify-content: center; }
.lightbox img { max-width: 90%; max-height: 90%; border-radius: 5px; object-fit: contain; }
.lightbox-close { position: absolute; top: 20px; right: 30px; color: #fff; font-size: 40px; cursor: pointer; font-weight: bold; }
.lightbox-prev, .lightbox-next { position: absolute; top: 50%; transform: translateY(-50%); color: white; font-size: 50px; font-weight: bold; cursor: pointer; user-select: none; padding: 20px; transition: 0.3s; }
.lightbox-prev:hover, .lightbox-next:hover { color: var(--primary-color); }
.lightbox-prev { left: 20px; }
.lightbox-next { right: 20px; }
</style>

<div id="lightbox" class="lightbox">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <span class="lightbox-prev" onclick="changeImage(-1)">&#10094;</span>
    <img id="lightbox-img" src="">
    <span class="lightbox-next" onclick="changeImage(1)">&#10095;</span>
</div>

<script>
var galleryImages = <?= !empty($post['gallery']) ? json_encode($post['gallery']) : '[]' ?>;
var currentImageIndex = 0;

function openLightbox(index) {
    currentImageIndex = index;
    document.getElementById('lightbox-img').src = galleryImages[currentImageIndex];
    document.getElementById('lightbox').style.display = 'flex';
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
}

function changeImage(direction) {
    currentImageIndex += direction;
    if (currentImageIndex >= galleryImages.length) {
        currentImageIndex = 0;
    } else if (currentImageIndex < 0) {
        currentImageIndex = galleryImages.length - 1;
    }
    document.getElementById('lightbox-img').src = galleryImages[currentImageIndex];
}

// Obsługa kliknięcia w tło
document.getElementById('lightbox').addEventListener('click', function(e) {
    if(e.target === this) closeLightbox();
});
</script>

<?php require_once 'footer.php'; ?>
