<?php
$seo_title = "Oferta - Technika, Animacje, Wynajem | LegacyEvents";
$seo_description = "Pełna oferta LegacyEvents. Zajmujemy się techniką sceniczną, animacjami, koncertami, dmuchanymi zamkami oraz wsparciem eventowym.";
require_once 'header.php';
require_once 'oferta_config.php';
?>

<main class="page-wrapper">
    <section class="subpage-hero">
        <h1 class="subpage-title">Nasza <span class="magical-text">Oferta</span></h1>
        <p class="subpage-subtitle">Zajmujemy się organizacją niezapomnianych wydarzeń, ale również dostarczamy
            najlepsze narzędzia i rozwiązania techniczne, pomagając Ci stworzyć magię na własnym evencie.</p>
    </section>

    <section class="content-section">
        <div class="oferta-grid">
            <?php foreach ($oferta_config as $key => $kategoria): ?>
                <a href="<?php echo htmlspecialchars($kategoria['link']); ?>" class="oferta-kategoria-card">
                    <img src="<?php echo htmlspecialchars($kategoria['image']); ?>"
                        alt="<?php echo htmlspecialchars($kategoria['title']); ?>" class="oferta-kategoria-bg">
                    <div class="oferta-kategoria-overlay"></div>
                    <div class="oferta-kategoria-content">
                        <h3><?php echo htmlspecialchars($kategoria['title']); ?></h3>
                        <p><?php echo htmlspecialchars($kategoria['desc']); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Strengths Section -->
    <section class="events-description-section strengths-section">
        <h2 class="section-title">Nasze <span class="magical-text">Mocne Strony</span></h2>
        <div class="events-grid">
            <div class="event-card">
                <div class="card-glow"></div>
                <h3>Ożywianie Przestrzeni</h3>
                <p>Potrafimy ożywiać średniowieczne ruiny za pomocą świateł i scenografii, podświetlamy profesjonalnym
                    światłem nawet rozległe tereny.</p>
            </div>
            <div class="event-card">
                <div class="card-glow"></div>
                <h3>Infrastruktura od Zera</h3>
                <p>Nie przerażają nas ruiny – jesteśmy w stanie zbudować bezpieczną sieć elektryczną, stabilne łącza
                    internetowe oraz zapewnić naszym artystom odpowiednie zaplecze nawet na obiektach nieposiadających
                    własnej infrastruktury.</p>
            </div>
            <div class="event-card">
                <div class="card-glow"></div>
                <h3>Nieskończona Kreatywność</h3>
                <p>Naszą przewagą jest kreatywność. Nie mamy jednego "Setu" czy "oferty" - do każdego obiektu
                    podchodzimy z uwagą, wykorzystujemy jego mocne strony i nie boimy się odważnych pomysłów.</p>
            </div>
            <div class="event-card">
                <div class="card-glow"></div>
                <h3>Emocje i Doświadczenia</h3>
                <p>Nasze wydarzenia to nie tylko patrzenioza. Dbamy o to aby były doświadczeniem, zawsze dostarczały
                    szerokiego wachlarzu emocji, jednocześnie pamiętając aby zapewnić miejsca idealne na zrobienie
                    rodzinnej fotograficznej pamiątki.</p>
            </div>
            <div class="event-card">
                <div class="card-glow"></div>
                <h3>Niezawodność Pogodowa</h3>
                <p>Posiadamy duże zaplecze sprzętów odpornych na warunki atmosferyczne, więc możemy bez problemu
                    pracować w trudnych warunkach.</p>
            </div>
            <div class="event-card">
                <div class="card-glow"></div>
                <h3>Zaawansowane Technologie</h3>
                <p>Wykorzystujemy nowoczesne rozwiązania do wspierania naszych wydarzeń - systemy rozproszonego
                    zbierania punktów, mechanizmy do komunikacji z uczestnikami dużych wydarzeń, integracje IOT.</p>
            </div>
        </div>
    </section>
</main>

<?php require_once 'footer.php'; ?>