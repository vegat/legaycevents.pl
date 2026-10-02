<?php require_once __DIR__ . '/seo.php'; ?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    // SEO zarządzane z panelu admina (data/*.json) ma pierwszeństwo, potem zmienne ustawione na stronie,
    // a na końcu domyślne wartości z seo.php
    $seo_config_file = __DIR__ . '/data/seo_config.json';
    $seo_cfg = file_exists($seo_config_file) ? json_decode(file_get_contents($seo_config_file), true) : [];
    if (!is_array($seo_cfg)) $seo_cfg = [];

    $pages_seo_file = __DIR__ . '/data/pages_seo.json';
    $pages_seo = file_exists($pages_seo_file) ? json_decode(file_get_contents($pages_seo_file), true) : [];
    if (!is_array($pages_seo)) $pages_seo = [];

    $graphics_seo_file = __DIR__ . '/data/graphics_seo.json';
    $graphics_seo = file_exists($graphics_seo_file) ? json_decode(file_get_contents($graphics_seo_file), true) : [];
    if (!is_array($graphics_seo)) $graphics_seo = [];

    $current_file = basename($_SERVER['SCRIPT_NAME']);
    if (isset($pages_seo[$current_file])) {
        $seo_title = $pages_seo[$current_file]['title'];
        $seo_description = $pages_seo[$current_file]['desc'];
    }

    $final_title = $seo_title ?? $seo['title'] ?? $seo_cfg['global_title'] ?? 'LegacyEvents';
    $final_desc = $seo_description ?? $seo['desc'] ?? $seo_cfg['global_description'] ?? '';

    $geo_name = $geo_placename ?? $seo_cfg['geo_placename'] ?? 'Bolków';
    $geo_pos_str = $geo_position ?? $seo_cfg['geo_position'] ?? '50.92, 16.10';
    $geo_pos_parts = array_map('trim', explode(',', $geo_pos_str));
    $geo_lat = $geo_pos_parts[0] ?? '50.92';
    $geo_lon = $geo_pos_parts[1] ?? '16.10';
    $og_img = $og_image ?? $seo_cfg['og_image'] ?? $seo_image;

    $seo_org['geo'] = ['@type' => 'GeoCoordinates', 'latitude' => (float) $geo_lat, 'longitude' => (float) $geo_lon];
    ?>
    <title><?= htmlspecialchars($final_title) ?></title>
    <?php if (!empty($final_desc)): ?>
    <meta name="description" content="<?= htmlspecialchars($final_desc) ?>">
    <?php endif; ?>
    <link rel="canonical" href="<?= htmlspecialchars($seo_canonical) ?>">
    <?php if (!empty($seo['noindex'])): ?>
    <meta name="robots" content="noindex, follow">
    <?php else: ?>
    <meta name="robots" content="index, follow, max-image-preview:large">
    <?php endif; ?>
    <meta name="theme-color" content="#0a0a12">
    <link rel="icon" type="image/svg+xml" href="/assets/logo.svg">
    <link rel="icon" type="image/png" sizes="192x192" href="/image.php?src=Logo/legacy_sticker.png&amp;w=192">
    <link rel="apple-touch-icon" href="/image.php?src=Logo/legacy_sticker.png&amp;w=180">

    <!-- Open Graph -->
    <meta property="og:type" content="<?= htmlspecialchars($og_type ?? 'website') ?>">
    <meta property="og:locale" content="pl_PL">
    <meta property="og:site_name" content="LegacyEvents">
    <meta property="og:title" content="<?= htmlspecialchars($final_title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($final_desc) ?>">
    <meta property="og:url" content="<?= htmlspecialchars($seo_canonical) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($og_img) ?>">
    <meta name="twitter:card" content="summary_large_image">

    <!-- GEO -->
    <meta name="geo.region" content="PL-DS" />
    <meta name="geo.placename" content="<?= htmlspecialchars($geo_name) ?>" />
    <meta name="geo.position" content="<?= htmlspecialchars($geo_lat) ?>;<?= htmlspecialchars($geo_lon) ?>" />
    <meta name="ICBM" content="<?= htmlspecialchars($geo_pos_str) ?>" />

    <?php if (isset($seo_tags)): ?>
        <?= $seo_tags ?>
    <?php endif; ?>

    <script type="application/ld+json"><?= json_encode($seo_org, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
    <?php if (isset($seo_schema)): ?>
        <?php // Strony przekazują schemat razem z tagiem <script> (ob_start), starszy format to sam JSON ?>
        <?= str_starts_with(ltrim($seo_schema), '<script') ? $seo_schema : '<script type="application/ld+json">' . $seo_schema . '</script>' ?>
    <?php endif; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Caveat:wght@600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css?v=3">
    <?php
    if (isset($heroSliderImages) && is_array($heroSliderImages)) {
        foreach ($heroSliderImages as $imgData) {
            $url = is_array($imgData) ? $imgData['url'] : $imgData;
            echo '<link rel="preload" as="image" href="/' . htmlspecialchars(ltrim($url, '/')) . '">';
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
    
    <!-- MIEJSCE NA KOD GOOGLE ANALYTICS (GA4) -->
    <!-- Odkomentuj i wstaw poniżej swój kod, np. gtag.js, kiedy będziesz gotowy -->
    <!-- 
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-XXXXXXXXXX');
    </script>
    -->

    <!-- MIEJSCE NA FACEBOOK PIXEL -->
    <!-- Odkomentuj i wstaw kod swojego Pixela FB -->
    <!--
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', 'XXXXXXXXXXXXXXX');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=XXXXXXXXXXXXXXX&ev=PageView&noscript=1"
    /></noscript>
    -->
</head>

<body>
    <header class="main-header">
        <div class="header-container">
            <div class="logo">
                <a href="/" aria-label="LegacyEvents - strona główna">
                    <img src="/image.php?src=Logo/legacyevents_transparent.png&h=80" alt="LegacyEvents" height="80">
                </a>
            </div>
            <nav class="main-nav">
                <ul class="nav-links">
                    <li><a href="/">Start</a></li>
                    <li class="dropdown">
                        <a href="/oferta">Oferta ▼</a>
                        <ul class="dropdown-menu">
                            <li><a href="/oferta_wydarzenia">Wydarzenia</a></li>
                            <li><a href="/oferta_technika">Technika</a></li>
                            <li><a href="/oferta_animacje">Animacje</a></li>
                            <li><a href="/oferta_rental">Rental</a></li>
                            <li><a href="/oferta_koncerty">Koncerty</a></li>
                            <li style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 5px; padding-top: 5px;"><a href="/oferta_zamki" style="color: var(--primary-color);">Dla Zamków 🏰</a></li>
                        </ul>
                    </li>
                    <li><a href="/galeria">Galeria</a></li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="/wspolpracujemy">Współpracujemy</a></li>
                    <li><a href="https://widget.legacyevents.pl/uslugi" target="_blank" rel="noopener">Konfigurator z cennikiem</a></li>
                    <li><a href="/kontakt">Kontakt</a></li>
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