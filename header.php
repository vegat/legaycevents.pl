<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $seo_title ?? 'LegacyEvents - Tworzymy światy, nie tylko eventy - Eventy, Pokazy Świetlne, Videomapping' ?></title>
    <?php if (isset($seo_description)): ?>
    <meta name="description" content="<?= htmlspecialchars($seo_description) ?>">
    <?php endif; ?>
    <?php if (isset($seo_tags)): ?>
    <?= $seo_tags ?>
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