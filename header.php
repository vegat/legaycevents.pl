<?php require_once __DIR__ . '/seo.php'; ?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($seo['title']); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($seo['desc']); ?>">
    <link rel="canonical" href="<?php echo htmlspecialchars($seo_canonical); ?>">
    <?php if (!empty($seo['noindex'])): ?>
    <meta name="robots" content="noindex, follow">
    <?php else: ?>
    <meta name="robots" content="index, follow, max-image-preview:large">
    <?php endif; ?>
    <meta name="theme-color" content="#0a0a12">
    <link rel="icon" type="image/svg+xml" href="/assets/logo.svg">
    <link rel="icon" type="image/png" sizes="192x192" href="/image.php?src=Logo/legacy_sticker.png&amp;w=192">
    <link rel="apple-touch-icon" href="/image.php?src=Logo/legacy_sticker.png&amp;w=180">

    <meta property="og:type" content="website">
    <meta property="og:locale" content="pl_PL">
    <meta property="og:site_name" content="LegacyEvents">
    <meta property="og:title" content="<?php echo htmlspecialchars($seo['title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($seo['desc']); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($seo_canonical); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($seo_image); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta name="twitter:card" content="summary_large_image">

    <script type="application/ld+json"><?php echo json_encode($seo_org, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG); ?></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Caveat:wght@600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css?v=3">
    <?php
    if (isset($heroSliderImages) && is_array($heroSliderImages)) {
        foreach ($heroSliderImages as $imgUrl) {
            echo '<link rel="preload" as="image" href="/' . htmlspecialchars($imgUrl) . '">';
        }
    }
    ?>
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
                    <li><a href="/wspolpracujemy">Współpracujemy</a></li>
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