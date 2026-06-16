<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/assets/Logo/legacy_sticker.png">
    <link rel="apple-touch-icon" href="/assets/Logo/legacy_sticker.png">
    <?php
    $seo_config_file = __DIR__ . '/data/seo_config.json';
    $seo_cfg = file_exists($seo_config_file) ? json_decode(file_get_contents($seo_config_file), true) : [];
    
    $pages_seo_file = __DIR__ . '/data/pages_seo.json';
    if (!file_exists($pages_seo_file)) {
        $default_pages_seo = [
            'index.php' => ['title' => 'Strona Główna - Agencja Eventowa LegacyEvents', 'desc' => 'Agencja LegacyEvents to profesjonalna organizacja wydarzeń, koncertów i pokazów. Wkrocz w świat zaawansowanej scenotechniki i zorganizuj wymarzony event.'],
            'oferta.php' => ['title' => 'Pełna Oferta - Technika, Wynajem, Animacje', 'desc' => 'Odkryj potężny arsenał możliwości LegacyEvents. Wynajem sprzętu, nagłośnienie, oświetlenie, animacje i technika estradowa.'],
            'oferta_animacje.php' => ['title' => 'Animacje i Kostiumy | Atrakcje na event', 'desc' => 'Zaczaruj swój event z LegacyEvents! Wynajem przepięknych kostiumów i profesjonalne animacje dla dzieci i dorosłych.'],
            'oferta_koncerty.php' => ['title' => 'Realizacja Koncertów | Obsługa Techniczna', 'desc' => 'Krystalicznie czysty dźwięk i oszałamiające efekty świetlne. Kompleksowa realizacja techniczna koncertów plenerowych, klubowych i festiwali.'],
            'oferta_rental.php' => ['title' => 'Wynajem Sprzętu Eventowego', 'desc' => 'Profesjonalny rental sprzętu eventowego. Oferujemy nowoczesne nagłośnienie, oświetlenie, konstrukcje sceniczne i lasery.'],
            'oferta_technika.php' => ['title' => 'Technika Sceniczna i Światła', 'desc' => 'Potężne nagłośnienie i widowiskowe światła. Zaufaj specjalistom z LegacyEvents i wykorzystaj bezkompromisową technikę sceniczną.'],
            'oferta_wydarzenia.php' => ['title' => 'Organizacja Wydarzeń i Eventów', 'desc' => 'Kompleksowo prowadzimy wydarzenia korporacyjne, festyny, eventy promocyjne i masowe od pierwszego szkicu aż po wielki finał.'],
            'oferta_zamki.php' => ['title' => 'Dmuchane Zamki i Zjeżdżalnie na Wynajem', 'desc' => 'Rozkręć każdą imprezę plenerową! Wypożycz ogromne dmuchane zamki, potężne zjeżdżalnie i kolorowe atrakcje dla dzieci.'],
            'kontakt.php' => ['title' => 'Kontakt z LegacyEvents', 'desc' => 'Masz pomysł na spektakularny event? Skontaktuj się z agencją LegacyEvents! Szybka darmowa wycena i doradztwo techniczne.'],
            'galeria.php' => ['title' => 'Galeria Realizacji Eventowych', 'desc' => 'Obrazy mówią więcej niż tysiąc słów. Zobacz zjawiskowe zdjęcia z naszych dotychczasowych realizacji, pokazów i koncertów.'],
            'wspolpracujemy.php' => ['title' => 'Nasi Partnerzy', 'desc' => 'Poznaj zaufane marki i profesjonalistów, z którymi LegacyEvents współtworzy największe widowiska na terenie całej Polski.']
        ];
        if (is_dir(__DIR__ . '/data')) {
            file_put_contents($pages_seo_file, json_encode($default_pages_seo, JSON_PRETTY_PRINT));
        }
    }
    
    $pages_seo = file_exists($pages_seo_file) ? json_decode(file_get_contents($pages_seo_file), true) : [];
    
    // Graphics SEO initialization
    $graphics_seo_file = __DIR__ . '/data/graphics_seo.json';
    if (!file_exists($graphics_seo_file)) {
        if (is_dir(__DIR__ . '/data')) {
            file_put_contents($graphics_seo_file, json_encode([], JSON_PRETTY_PRINT));
        }
    }
    $graphics_seo = file_exists($graphics_seo_file) ? json_decode(file_get_contents($graphics_seo_file), true) : [];
    if (!is_array($graphics_seo)) $graphics_seo = [];
    
    $current_file = basename($_SERVER['PHP_SELF']);
    
    if (isset($pages_seo[$current_file])) {
        $seo_title = $pages_seo[$current_file]['title'];
        $seo_description = $pages_seo[$current_file]['desc'];
    }

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
    <link rel="canonical" href="<?= htmlspecialchars($current_url) ?>" />
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
        foreach ($heroSliderImages as $imgData) {
            $url = is_array($imgData) ? $imgData['url'] : $imgData;
            echo '<link rel="preload" as="image" href="' . htmlspecialchars($url) . '">';
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