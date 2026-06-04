<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $seo_config_file = __DIR__ . '/data/seo_config.json';
    $seo_cfg = file_exists($seo_config_file) ? json_decode(file_get_contents($seo_config_file), true) : [];
    
    $final_title = $seo_title ?? $seo_cfg['global_title'] ?? 'LegacyEvents';
    $final_desc = $seo_description ?? $seo_cfg['global_description'] ?? '';
    
    $geo_name = $geo_placename ?? $seo_cfg['geo_placename'] ?? 'Bolków';
    $geo_pos_str = $geo_position ?? $seo_cfg['geo_position'] ?? '50.92, 16.10';
    $geo_pos_parts = array_map('trim', explode(',', $geo_pos_str));
    $geo_lat = $geo_pos_parts[0] ?? '50.92';
    $geo_lon = $geo_pos_parts[1] ?? '16.10';
    $og_img = $og_image ?? $seo_cfg['og_image'] ?? ('https://' . $_SERVER['HTTP_HOST'] . '/assets/Logo/legacyevents_transparent.png');
    $current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>
    <title><?= htmlspecialchars($final_title) ?></title>
    <?php if (!empty($final_desc)): ?>
    <meta name="description" content="<?= htmlspecialchars($final_desc) ?>">
    <?php endif; ?>
    
    <!-- Open Graph Global -->
    <meta property="og:title" content="<?= htmlspecialchars($final_title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($final_desc) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($og_img) ?>">
    <meta property="og:url" content="<?= htmlspecialchars($current_url) ?>">
    <meta property="og:type" content="<?= $og_type ?? 'website' ?>">
    
    <!-- GEO Tags Global -->
    <meta name="geo.region" content="PL-DS" />
    <meta name="geo.placename" content="<?= htmlspecialchars($geo_name) ?>" />
    <meta name="geo.position" content="<?= htmlspecialchars($geo_lat) ?>;<?= htmlspecialchars($geo_lon) ?>" />
    <meta name="ICBM" content="<?= htmlspecialchars($geo_pos_str) ?>" />

    <?php if (isset($seo_tags)): ?>
        <?= $seo_tags ?>
    <?php endif; ?>
    
    <?php if (isset($seo_schema)): ?>
        <script type="application/ld+json"><?= $seo_schema ?></script>
    <?php else: ?>
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "LocalBusiness",
          "name": "LegacyEvents",
          "image": "<?= htmlspecialchars($og_img) ?>",
          "url": "https://<?= $_SERVER['HTTP_HOST'] ?>",
          "address": {
            "@type": "PostalAddress",
            "addressLocality": "<?= htmlspecialchars($geo_name) ?>",
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
        </script>
    <?php endif; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Caveat:wght@600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=3">
    <?php
    if (isset($heroSliderImages) && is_array($heroSliderImages)) {
        foreach ($heroSliderImages as $imgUrl) {
            echo '<link rel="preload" as="image" href="' . htmlspecialchars($imgUrl) . '">';
        }
    }
    
    // Zabezpieczenie danych bloga przed nadpisaniem przez Git Pull
    $posts_file = __DIR__ . '/data/posts.json';
    $backup_file = __DIR__ . '/data/posts_backup.json';
    if (file_exists($posts_file)) {
        $content = file_get_contents($posts_file);
        if (strlen($content) > 5) { // Jeśli plik nie jest pusty/pustą tablicą
            file_put_contents($backup_file, $content);
        }
    } elseif (file_exists($backup_file)) {
        // Przywracanie, jeśli Git skasował oryginalny plik podczas aktualizacji
        copy($backup_file, $posts_file);
    }
    ?>
</head>

<body>
    <header class="main-header">
        <div class="header-container">
            <div class="logo">
                <a href="/">
                    <img src="image.php?src=Logo/legacyevents_transparent.png&h=80" alt="LegacyEvents Logo">
                </a>
            </div>
            <nav class="main-nav">
                <ul class="nav-links">
                    <li><a href="/">Start</a></li>
                    <li class="dropdown">
                        <a href="oferta">Oferta ▼</a>
                        <ul class="dropdown-menu">
                            <li><a href="oferta_wydarzenia">Wydarzenia</a></li>
                            <li><a href="oferta_technika">Technika</a></li>
                            <li><a href="oferta_animacje">Animacje</a></li>
                            <li><a href="oferta_rental">Rental</a></li>
                            <li><a href="oferta_koncerty">Koncerty</a></li>
                            <li style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 5px; padding-top: 5px;"><a href="oferta_zamki" style="color: var(--primary-color);">Dla Zamków 🏰</a></li>
                        </ul>
                    </li>
                    <li><a href="galeria">Galeria</a></li>
                    <li><a href="blog">Blog</a></li>
                    <li><a href="wspolpracujemy">Współpracujemy</a></li>
                    <li><a href="https://widget.legacyevents.pl/uslugi" target="_blank">Konfigurator z cennikiem</a></li>
                    <li><a href="kontakt">Kontakt</a></li>
                </ul>
            </nav>
            <button class="mobile-menu-toggle" aria-label="Przełącz menu">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>
    </header>