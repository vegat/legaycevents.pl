<?php
$seo_title = "Organizacja Wydarzeń | LegacyEvents";
$seo_description = "Kompleksowa organizacja wydarzeń masowych i firmowych. Zajmiemy się wszystkim od A do Z.";
ob_start(); ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Organizacja Wydarzeń",
  "provider": { "@type": "LocalBusiness", "name": "LegacyEvents" },
  "description": "Kompleksowa organizacja wydarzeń masowych i firmowych. Zajmiemy się wszystkim od A do Z."
}
</script>
<?php $seo_schema = ob_get_clean();
require_once 'header.php';
require_once 'oferta_config.php';
$cat = $oferta_config['wydarzenia'];
?>

<main class="page-wrapper">
    <section class="subpage-hero-with-bg">
        <img src="<?php echo htmlspecialchars($cat['image']); ?>" alt="Background" class="subpage-hero-bg">
        <div class="subpage-hero-content">
            <h1 class="subpage-title">Wydarzenia & <span class="magical-text">Wsparcie</span></h1>
            <p class="subpage-subtitle">Ożywiamy mury. Tworzymy światy, w które zechcesz wskoczyć.</p>
        </div>
    </section>

    <section class="content-section text-content">
        <p class="lead">Jesteśmy kreatywną ekipą, dla której słowo „standardowo” po prostu nie istnieje.</p>
        <p>Od lat z sukcesem organizujemy autorskie wydarzenia, które na długo zostają w głowach uczestników. Od
            rodzinnych przygód w <strong>Akademii Magii</strong>, przez <strong>Gildię Magii</strong> i <strong>Smocze
                Dziedzictwo</strong>, aż po szalone muzyczne fuzje – jak <span class="magical-text">Dragon Disco</span>
            (house w średniowiecznym klimacie) czy <strong>Cyberpunkowy Festiwal</strong>.</p>

        <div class="pull-quote">Do tej pory tworzyliśmy magię głównie dla naszych gości. Teraz otwieramy te drzwi
            szerzej.</div>
        <p>Jesteś zarządcą zamku lub obiektu historycznego? Reprezentujesz gminę? A może szukasz kogoś, kto zrobi
            totalnie nieszablonową imprezę dla Twojej firmy? <span class="magical-text">Świetnie trafiłeś.</span></p>

        <h2>Liczby mówią same za siebie</h2>
        <p>Nie rzucamy słów na wiatr. Kiedy robimy imprezę, przestrzeń ożywa. Nasz <strong>Cyberpunkowy
                Festiwal</strong> na Zamku w Bolkowie ściągnął <strong>ponad 800 uczestników</strong>. Seria wydarzeń
            „Elfy Przejmują Zamek” (Świny, Międzyrzecz, Ząbkowice Śląskie) zgromadziła łącznie <strong>ponad 1000
                osób</strong>, a sama <strong>Akademia Magii</strong> w Międzyrzeczu przyciągnęła <strong>800 fanów
                czarów</strong>. Wiemy, jak zarządzać tłumem i jak zrobić to dobrze.</p>

        <div style="display: flex; gap: 40px; flex-wrap: wrap; align-items: flex-start; margin: 3rem 0;">
            <div style="flex: 1; min-width: 280px;">
                <h2>Przeżywaj, nie tylko scrolluj</h2>
                <p>Kochamy technologię, ale mamy do niej zdrowy dystans. Unikamy „ekranozy”. Technologia ma u nas
                    <strong>budować klimat</strong>, a nie go zasłaniać. Jesteśmy za to mistrzami malowania światłem – z
                    pasją przygotowujemy <strong>pokazy laserowe</strong>, a dzięki <strong>videomappingowi</strong>
                    potrafimy tchnąć życie w każdy element architektoniczny. Wasze smartfony przydadzą się co najwyżej
                    do złapania kilku obłędnych kadrów na pamiątkę. Resztę czasu spędzicie w samym środku akcji.</p>

                <h2>Wciągamy w grę</h2>
                <p>Nasze eventy to <span class="magical-text">pełna interakcja</span>. Zapomnijcie o nudnych,
                    przewidywalnych scenariuszach i statystach. Pracujemy z ekipą piekielnie zaangażowanych aktorów – to
                    postacie z krwi i kości, które wchodzą w dialog, prowokują do działania i dbają o to, by każda
                    minuta była wypełniona emocjami i świetną zabawą.</p>
            </div>
            <div style="flex: 0 0 340px;">
                <?php
                $photos = glob('assets/EventPhotos/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
                if ($photos) {
                    $src = str_replace('assets/', '', $photos[array_rand($photos)]);
                    echo '<img src="image.php?src=' . urlencode($src) . '&w=600&h=400&crop=1" alt="Wydarzenie" style="width:100%; border-radius:12px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); border: 1px solid var(--border-color);">';
                }
                ?>
            </div>
        </div>

        <h2>Zbudujemy miasto w środku niczego <span
                style="font-weight: 400; font-size: 0.85em; color: var(--text-muted);">(i zrobimy to bezpiecznie)</span>
        </h2>
        <p>Brzmi jak artystyczny odlot? Spokojnie – logistycznie stoimy twardo na ziemi. Rzucisz nas na opuszczone,
            surowe ruiny? Daj nam chwilę. Błyskawicznie stawiamy tam <strong>pełną infrastrukturę</strong>: prąd, szybki
            internet, oświetlenie, potężne nagłośnienie i niezbędne zaplecze gastronomiczne.</p>
        <p>Działamy z wyobraźnią, ale naszym absolutnym priorytetem jest <strong>bezpieczeństwo</strong>. Nie ma u nas
            miejsca na prowizorkę. Rzetelnie dbamy o komfort aktorów i uczestników, a nasz sprzęt przechodzi
            rygorystyczne i regularne przeglądy.</p>

        <p class="lead">Nieważne, czy oddasz nam w ręce średniowieczny zamek, czy surową halę. Zrobimy z tego
            wydarzenie, o którym będzie się mówić.</p>

        <div style="margin-top: 60px; text-align: center;">
            <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                <a href="kontakt" class="cta-button primary">Opowiedz nam o swoim pomyśle – darmowa wycena</a>
                <a href="https://widget.legacyevents.pl/uslugi" target="_blank" class="cta-button primary">KONFIGURATOR USŁUG Z CENNIKIEM</a>
            </div>
        </div>
    </section>
</main>

<?php require_once 'footer.php'; ?>