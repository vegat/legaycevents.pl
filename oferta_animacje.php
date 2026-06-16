<?php
$seo_title = "Animacje i Kostiumy | LegacyEvents";
$seo_description = "Profesjonalne animacje i wynajem kostiumów na eventy. Zapewniamy niezapomniane wrażenia dla uczestników każdego wydarzenia.";
ob_start(); ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Animacje i Kostiumy",
  "provider": { "@type": "LocalBusiness", "name": "LegacyEvents" },
  "description": "Profesjonalne animacje i wynajem kostiumów na eventy. Zapewniamy niezapomniane wrażenia dla uczestników każdego wydarzenia."
}
</script>
<?php $seo_schema = ob_get_clean();
require_once 'header.php';
require_once 'oferta_config.php';
$cat = $oferta_config['animacje'];
?>

<main class="page-wrapper">
    <section class="subpage-hero-with-bg">
        <img src="<?php echo htmlspecialchars($cat['image']); ?>" alt="Background" class="subpage-hero-bg">
        <div class="subpage-hero-content">
            <h1 class="subpage-title">Animacje & <span class="magical-text">Kostiumy</span></h1>
            <p class="subpage-subtitle">Ludzie, którzy stają się światem. Nasi aktorzy i akrobaci.</p>
        </div>
    </section>

    <section class="content-section text-content">
        <p class="lead">Najlepsze nagłośnienie i najdroższe lasery nie stworzą magii, jeśli zabraknie w niej człowieka.
        </p>
        <p>Trzonem naszych wydarzeń i absolutnym sercem tego, co robimy, jest <strong>utalentowana grupa
                teatralno-akrobatyczna</strong>. To oni wprowadzają ten nieuchwytny, gęsty klimat, którego nie
            znajdziecie nigdzie indziej. Dlatego dbamy aby pracowało się im z nami dobrze i mieli przestrzeń na
            realizację swoich umiejętności i kreatywności.</p>

        <h2>Nie odgrywamy ról. My w nie wchodzimy</h2>
        <p>Zapomnijcie o zmęczonych statystach, którzy tylko odliczają czas do końca zlecenia. Nasi artyści <span
                class="magical-text">kochają to, co robią</span>. Nie trzymamy ich w sztywnych ramach scenariusza –
            dajemy im pełną swobodę twórczą. Dzięki temu w każdą postać wkładają cząstkę siebie, co przekłada się na
            stuprocentową spójność i autentyczność. Kiedy spotkasz na zamku smoczego władcę, elfa czy potężnego maga, po
            prostu uwierzysz, że oni są z tego świata.</p>

        <div style="display: flex; gap: 40px; flex-wrap: wrap; align-items: flex-start; margin: 3rem 0;">
            <div style="flex: 1; min-width: 280px;">
                <h2>Mistrzowie detalu i dobrego słowa</h2>
                <p>Autentyczność zaczyna się od wyglądu. Nasza ekipa nie polega na tanich wypożyczalniach –
                    <strong>stroje szyją w większości własnoręcznie</strong>, pieczołowicie dbając o każdy detal
                    charakteryzacji. Ich największą siłą jest jednak <strong>empatia</strong>. Znani z tego, że wyłapują
                    z tłumu każdego uczestnika. Dbają o każdy uśmiech, drobną interakcję i dobre słowo, sprawiając, że
                    każdy gość czuje się ważną częścią opowieści.
                </p>

                <h2>Animacje bez piskliwych klaunów</h2>
                <p>Szanujemy inteligencję i wyobraźnię najmłodszych. Tworzymy dla nich magiczne chwile, ale z dala od
                    sztampy i kiczowatych zabaw. Nasze animacje to <strong>pełnoprawne, fabularyzowane przygody</strong>
                    – od warsztatów w Szkole Czarodziejów po pełne emocji poszukiwania smoczych jaj. Dzieciaki nie są u
                    nas tylko widzami – są <span class="magical-text">głównymi bohaterami historii</span>.</p>
            </div>
            <div style="flex: 0 0 340px;">
                <?php
                $photos = glob('assets/EventPhotos/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
                if ($photos) {
                    $rand_photo = $photos[array_rand($photos)];
                    $src = str_replace('assets/', '', $rand_photo);
                    $alt = !empty($graphics_seo[$rand_photo]['alt']) ? htmlspecialchars($graphics_seo[$rand_photo]['alt']) : 'Animacje Eventowe';
                    $title_attr = !empty($graphics_seo[$rand_photo]['title']) ? 'title="' . htmlspecialchars($graphics_seo[$rand_photo]['title']) . '"' : '';
                    echo '<img src="image.php?src=' . urlencode($src) . '&w=600&h=400&crop=1" alt="' . $alt . '" ' . $title_attr . ' style="width:100%; border-radius:12px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); border: 1px solid var(--border-color);">';
                }
                ?>
            </div>
        </div>

        <div
            style="background: var(--card-bg); border: 1px solid var(--border-color); border-radius: 12px; padding: 28px 32px; margin: 2.5rem 0;">
            <h3
                style="color: var(--secondary-color); font-family: var(--font-heading); margin: 0 0 15px; font-size: 1.2rem;">
                Dla kogo animujemy?</h3>
            <p style="margin: 0; color: var(--text-muted); line-height: 1.7;">Oferujemy animacje i programy dla <strong
                    style="color:#fff;">dzieci</strong>, <strong style="color:#fff;">szkół</strong>, <strong
                    style="color:#fff;">obiektów handlowych</strong> oraz <strong style="color:#fff;">firm</strong> – od
                urodzin i eventów rodzinnych, przez wycieczki szkolne i dni otwarte, po integracje i premiery w
                nietypowych lokalizacjach. Dopasowujemy scenariusze i postacie do Waszej publiczności oraz charakteru
                miejsca.</p>
        </div>

        <h2>Igranie z ogniem <span
                style="font-weight: 400; font-size: 0.85em; color: var(--text-muted);">(dosłownie)</span></h2>
        <p>A kiedy zapada zmrok, nasza ekipa wyciąga najcięższe działa. Od wielu lat pracują z <strong>zaawansowaną
                akrobatyką i ogniem</strong>. To nie jest zwykłe machanie pochodniami – ich spektakularne <strong>pokazy
                fireshow</strong> regularnie zgarniają najwyższe nagrody na ogólnopolskich festiwalach. To mistrzowskie,
            zapierające dech w piersiach widowisko, które stanowi <span class="magical-text">idealny finał każdego
                wydarzenia</span>.</p>

        <div style="margin-top: 60px; text-align: center;">
            <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                <a href="kontakt" class="cta-button primary">Opowiedz nam o swoim evencie – dopasujemy animacje</a>
                <a href="https://widget.legacyevents.pl/uslugi" target="_blank" class="cta-button primary">KONFIGURATOR USŁUG Z CENNIKIEM</a>
            </div>
        </div>
    </section>
</main>

<?php require_once 'footer.php'; ?>