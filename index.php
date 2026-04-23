<?php
// Prepare hero slider images before header to allow preloading
$heroSliderImages = [];
$photos = glob('assets/EventPhotos/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
$horizontalPhotos = [];

if ($photos) {
    foreach ($photos as $photo) {
        $size = @getimagesize($photo);
        if ($size && $size[0] > $size[1]) { // width > height
            $horizontalPhotos[] = $photo;
        }
    }

    if (!empty($horizontalPhotos)) {
        shuffle($horizontalPhotos);
        $sliderPhotos = array_slice($horizontalPhotos, 0, 5); // Take 5 random photos
        foreach ($sliderPhotos as $photo) {
            $src = str_replace('assets/', '', $photo);
            $heroSliderImages[] = 'image.php?src=' . urlencode($src) . '&w=1200&h=800&crop=1';
        }
    }
}
require_once 'header.php';
?>
<main class="page-start">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background-glow"></div>
        <div class="hero-content">
            <h1 class="hero-title">
                Tworzymy <br>
                <div class="magical-text-wrapper"><span id="animated-word"
                        class="magical-text word-visible">IMMERSYJNE</span></div> <br>
                Światy.
            </h1>
            <p class="hero-subtitle">Nasze wydarzenia nie są tylko do patrzenia - są to doświadczenia. Daj się porwać
                kreatywnym światom, które sprowadzamy na najciekawsze lokalizacje w Polsce.</p>
            <div class="hero-buttons">
                <a href="oferta" class="cta-button primary">Odkryj Naszą Ofertę</a>
                <a href="kontakt" class="cta-button secondary">Skontaktuj się</a>
            </div>
        </div>
        <div class="hero-graphic">
            <div class="hero-slider-container">
                <?php
                if (!empty($heroSliderImages)) {
                    foreach ($heroSliderImages as $index => $imgUrl) {
                        // Start active only the first slide
                        $activeClass = $index === 0 ? 'active' : '';
                        echo '<div class="hero-slide ' . $activeClass . '">';
                        echo '<img src="' . htmlspecialchars($imgUrl) . '" class="slide-image" alt="Event" loading="eager" decoding="async" />';
                        echo '<div class="light-ray-overlay"></div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="stats-container">
            <div class="stat-box">
                <div class="stat-number-wrapper">
                    <span class="stat-number" data-target="15">0</span><span class="stat-plus">+</span>
                </div>
                <span class="stat-label">Wydarzeń</span>
            </div>
            <div class="stat-box">
                <div class="stat-number-wrapper">
                    <span class="stat-number" data-target="10000">0</span><span class="stat-plus">+</span>
                </div>
                <span class="stat-label">Uczestników</span>
            </div>
            <div class="stat-box">
                <div class="stat-number-wrapper">
                    <span class="stat-number" data-target="6">0</span><span class="stat-plus">+</span>
                </div>
                <span class="stat-label">Lokalizacji</span>
            </div>
        </div>
    </section>

    <!-- Full Width Feature Image & Upcoming Event Box -->
    <?php
    // Zmienna z zewnętrznym URL do pliku JSON z danymi wydarzenia
    $event_json_url = 'https://raw.githubusercontent.com/vegat/legacyconfig/refs/heads/main/LegacyNextEvent.json';
    $cache_file = __DIR__ . '/upcoming_event_cache.json';
    $cache_time = 86400; // 24h w sekundach

    // Zmienne domyślne dla stanu błędu - fallback na obecny wygląd (Wkrótce)
    $upcoming_event = [
        'subtitle' => 'Już wkrótce zobaczymy się na...',
        'title' => 'Akademii Magii',
        'date' => 'Wkrótce',
        'link' => '#',
        'social_text' => 'Obserwuj na FB/Instagram aby być na bieżąco!',
        'social_link' => 'https://www.facebook.com/profile.php?id=61560702814608' // docelowy link z kontaktu
    ];

    $fetched_event = null;
    $is_active_event = false;

    // Sprawdzenie czy cache istnieje i czy jest wazny (ponizej 24h)
    if (file_exists($cache_file) && (time() - filemtime($cache_file)) < $cache_time) {
        $json_data = file_get_contents($cache_file);
        if ($json_data !== false) {
            $fetched_event = json_decode($json_data, true);
        }
    } else {
        // Pobieranie nowych danych z URL jeśli cache wygasł
        $context = stream_context_create(['http' => ['timeout' => 5]]);
        $json_data = @file_get_contents($event_json_url, false, $context);
        
        if ($json_data !== false) {
            $parsed = json_decode($json_data, true);
            if ($parsed !== null) {
                file_put_contents($cache_file, $json_data);
                $fetched_event = $parsed;
            }
        } elseif (file_exists($cache_file)) {
            // W razie błędu serwera JSON, zaczytanie ostatniego dobrego cache, nawet jeśli jest stary
            $fetched_event = json_decode(file_get_contents($cache_file), true);
        }
    }

    // Aplikowanie pobranych danych z JSON;
    if (is_array($fetched_event) && isset($fetched_event['active']) && $fetched_event['active']) {
        $is_active_event = true;
        // Aktualizacja tytułu, daty i linku jeśli przesłane
        $upcoming_event['title'] = !empty($fetched_event['title']) ? $fetched_event['title'] : $upcoming_event['title'];
        $upcoming_event['date']  = !empty($fetched_event['date']) ? $fetched_event['date'] : $upcoming_event['date'];
        $upcoming_event['link']  = !empty($fetched_event['link']) ? $fetched_event['link'] : $upcoming_event['link'];
    } elseif (is_array($fetched_event) && isset($fetched_event['active']) && !$fetched_event['active']) {
        // Jeśli JSON zadeklarował brak bieżącego wydarzenia, wyświetlamy status "Wkrótce"
        $upcoming_event['title'] = !empty($fetched_event['title']) ? $fetched_event['title'] : 'Kolejnych Naszych Wydarzeniach';
        $upcoming_event['date']  = 'Wkrótce';
        $upcoming_event['link']  = '#';
    }
    ?>
    <section class="feature-image-section">
        <div class="feature-image-wrapper">
            <img src="image.php?src=EventPhotos%2F577179540_122198133062356760_1377272530612077950_n.jpg&w=1920&h=800&crop=1"
                alt="Nasze wydarzenia" loading="lazy">
            <div class="feature-image-overlay"></div>
        </div>

        <div class="upcoming-event-box">
            <div class="upcoming-content">
                <p class="upcoming-subtitle"><?php echo htmlspecialchars($upcoming_event['subtitle']); ?></p>
                <h2 class="upcoming-title magical-text"><?php echo htmlspecialchars($upcoming_event['title']); ?>
                </h2>

                <div class="upcoming-details">
                    <div class="upcoming-detail">
                        <span class="detail-label">Data:</span>
                        <span class="detail-value"><?php echo htmlspecialchars($upcoming_event['date']); ?></span>
                    </div>
                    <?php if ($is_active_event && $upcoming_event['link'] !== '#'): ?>
                    <a href="<?php echo htmlspecialchars($upcoming_event['link']); ?>"
                        class="cta-button primary small-btn">Sprawdź wydarzenie</a>
                    <?php else: ?>
                    <a href="<?php echo htmlspecialchars($upcoming_event['link']); ?>"
                        class="cta-button primary small-btn">Link do wydarzenia: Wkrótce!</a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="upcoming-social">
                <a href="<?php echo htmlspecialchars($upcoming_event['social_link']); ?>" target="_blank"
                    class="social-follow-btn">
                    <?php echo htmlspecialchars($upcoming_event['social_text']); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- 3D Carousel Section -->
    <section class="creative-carousel-section">
        <h2 class="section-title">Magia w <span class="magical-text">Obiektywie</span></h2>
        <div class="carousel-viewport">
            <div class="carousel-track" id="carouselTrack">
                <?php
                $photos = glob('assets/EventPhotos/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
                if ($photos) {
                    shuffle($photos); // Randomize on each reload
                    // Add duplicate set at the end for seamless looping
                    $carouselImages = array_merge($photos, $photos);
                    foreach ($carouselImages as $photo) {
                        $src = str_replace('assets/', '', $photo);
                        echo '<div class="carousel-item">';
                        echo '<img src="image.php?src=' . urlencode($src) . '&w=400&h=250&crop=1" alt="Event Photo" loading="lazy" />';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <a href="galeria" class="cta-button secondary">Zobacz więcej uchwyconych chwil</a>
        </div>
    </section>

    <!-- Events Descriptions Section -->
    <section class="events-description-section">
        <h2 class="section-title">Możecie znać nas m.in. <span class="magical-text">z...</span></h2>
        <div class="events-grid">
            <div class="event-card">
                <div class="card-glow"></div>
                <h3>Akademia Magii</h3>
                <p>Magiczne wydarzenie dla adeptów i fanów czarodziejów, magicznych stworzeń oraz czarodziejskiego
                    świata. Pełne zagadek, zaklęć i odkryć czekających na Młodych Czarodziejów.</p>
            </div>
            <div class="event-card">
                <div class="card-glow"></div>
                <h3>Smocze Dziedzictwo</h3>
                <p>Wydarzenie w klimacie Smoków i Średniowiecza, gdzie dwa rody na zamku walczą o uzyskanie Smoczej
                    Korony, a wszyscy uczestnicy wydarzeń biorą aktywny udział i mają realny wpływ na finał wydarzenia.
                </p>
            </div>
            <div class="event-card">
                <div class="card-glow"></div>
                <h3>Elfy przejmują zamek</h3>
                <p>Świąteczne wydarzenie nastrajające klimatem do świąt, miejsce gdzie niemal podejrzeć można jak
                    mogłyby wyglądać przygotowania do świąt, gdyby zarządzały nimi Świąteczne Elfy.</p>
            </div>
            <div class="event-card cyberpunk">
                <div class="card-glow cyberpunk-glow"></div>
                <h3>Moonlight Castle Festival</h3>
                <p>Cyberpunkowy festiwal muzyczny, który zamienia średniowieczne ruiny Zamku Bolków w cyberpunkową
                    twierdzę pełną elektronicznych dźwięków oraz neonowych świateł.</p>
            </div>
        </div>
    </section>

    <!-- Specialist Hero Section -->
    <section class="specialist-hero"
        style="padding: 100px 20px; text-align: center; background: linear-gradient(to bottom, var(--surface-color), var(--bg-color));">
        <div style="max-width: 900px; margin: 0 auto;">
            <h2 class="section-title" style="margin-bottom: 20px;">
                Jesteśmy <span class="magical-text">specjalistami</span> w ożywianiu <span class="magical-text">zamków,
                    ruin</span> i innych obiektów historycznych
            </h2>
            <div
                style="width: 100px; height: 3px; background: var(--primary-glow); margin: 0 auto 30px auto; box-shadow: 0 0 10px var(--primary-color);">
            </div>
        </div>
    </section>

    <!-- Apps Showcase Section -->
    <section class="apps-showcase-section">
        <h2 class="section-title">Nasze <span class="magical-text">Technologie</span></h2>

        <div class="app-showcase-container">
            <?php
            // Konfiguracja aplikacji dla efekciarskiego widoku
            $our_apps = [
                [
                    'identifier' => 'legacyid',
                    'title' => 'id.legacyevents.pl',
                    'url' => 'https://id.legacyevents.pl',
                    'desc' => 'Jeden wspólny mechanizm logowania i zdobywania odznak dla uczestników wszystkich naszych wydarzeń. Kolekcjonuj pamiątki po wspaniałych chwilach.',
                    'desktop_img' => 'image.php?src=AppScreens/id.legacyevents.pl/desktop1.png&w=1200&h=0',
                    'mobile_imgs' => [
                        'image.php?src=AppScreens/id.legacyevents.pl/mobile1.png&w=600&h=0',
                        'image.php?src=AppScreens/id.legacyevents.pl/mobile2.png&w=600&h=0'
                    ]
                ],
                [
                    'identifier' => 'huntmap',
                    'title' => 'huntmap.eu',
                    'url' => 'https://huntmap.eu',
                    'desc' => 'System do tworzenia gier terenowych, idealny dla gmin, miast oraz instytucji turystycznych. Doskonały także dla każdego, kto ma dryg do tworzenia własnych przygód. Unikatowy system zarabiania na udostępnionych przygodach.',
                    'desktop_img' => 'image.php?src=AppScreens/huntmap.eu/desktop1.png&w=1200&h=0',
                    'mobile_imgs' => [
                        'image.php?src=AppScreens/huntmap.eu/mobile1.png&w=600&h=0',
                        'image.php?src=AppScreens/huntmap.eu/mobile2.png&w=600&h=0',
                        'image.php?src=AppScreens/huntmap.eu/mobile3.png&w=600&h=0',
                        'image.php?src=AppScreens/huntmap.eu/mobile4.png&w=600&h=0',
                        'image.php?src=AppScreens/huntmap.eu/mobile5.png&w=600&h=0'
                    ]
                ],
                [
                    'identifier' => 'notigo',
                    'title' => 'notigo.eu',
                    'url' => 'https://notigo.eu',
                    'desc' => 'Aplikacja dla organizatorów wydarzeń typu rajdy, maratony, rozproszone wydarzenia - pozwala w ultra-łatwy sposób użytkownikom otrzymywać informacje od organizatorów, dodawać zdjęcia w trakcie trwania wydarzenia a także komunikować się z innymi zawodnikami.',
                    'desktop_img' => 'image.php?src=AppScreens/notigo.eu/desktop.png&w=1200&h=0',
                    'mobile_imgs' => [
                        'image.php?src=AppScreens/notigo.eu/mobile1.png&w=600&h=0',
                    ]
                ]
            ];

            foreach ($our_apps as $index => $app):
                $is_reversed = ($index % 2 !== 0) ? 'reversed' : '';
                ?>
                <div class="app-showcase-item <?php echo $is_reversed; ?>">
                    <div class="app-devices">
                        <div class="desktop-mockup">
                            <div class="mac-header">
                                <span class="dot close"></span>
                                <span class="dot minimize"></span>
                                <span class="dot maximize"></span>
                            </div>
                            <img src="<?php echo htmlspecialchars($app['desktop_img']); ?>"
                                alt="Desktop <?php echo $app['title']; ?>">
                        </div>
                        <div class="mobile-mockup">
                            <div class="mobile-notch"></div>
                            <div class="mobile-screen fade-slideshow">
                                <?php foreach ($app['mobile_imgs'] as $imgIndex => $mImg): ?>
                                    <img src="<?php echo htmlspecialchars($mImg); ?>"
                                        class="<?php echo $imgIndex === 0 ? 'active' : ''; ?>"
                                        alt="Mobile <?php echo $app['title']; ?> <?php echo $imgIndex; ?>">
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="app-info">
                        <h3><?php echo $app['title']; ?></h3>
                        <p><?php echo $app['desc']; ?></p>
                        <a href="<?php echo $app['url']; ?>" target="_blank" rel="noopener noreferrer"
                            class="cta-button primary">Skontaktuj się aby skorzystać!</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php require_once 'footer.php'; ?>