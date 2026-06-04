<?php
$seo_title = "Technika Sceniczna | LegacyEvents";
$seo_description = "Nowoczesna technika sceniczna, światła, sceny, efekty specjalne i lasery. Tworzymy niesamowite widowiska.";
ob_start(); ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Technika Sceniczna",
  "provider": { "@type": "LocalBusiness", "name": "LegacyEvents" },
  "description": "Nowoczesna technika sceniczna, światła, sceny, efekty specjalne i lasery. Tworzymy niesamowite widowiska."
}
</script>
<?php $seo_schema = ob_get_clean();
require_once 'header.php';
require_once 'oferta_config.php';
$cat = $oferta_config['technika'];
?>

<main class="page-wrapper">
    <section class="subpage-hero-with-bg">
        <img src="<?php echo htmlspecialchars($cat['image']); ?>" alt="Background" class="subpage-hero-bg">
        <div class="subpage-hero-content">
            <h1 class="subpage-title">Technika <span class="magical-text">Sceniczna</span></h1>
            <p class="subpage-subtitle">Ożywiamy mury. Tworzymy światy, w które zechcesz wskoczyć.</p>
        </div>
    </section>

    <section class="content-section text-content">
        <p class="lead">Jesteśmy kreatywną ekipą, która nie uznaje słowa „standardowo”.</p>
        <p>Tworzymy nieszablonowe wydarzenia – od magicznych akademii dla rodzin, przez elfie inwazje na zamki, aż po
            <strong>cyberpunkowe festiwale</strong> i epickie integracje dla firm. Ale wyobraźnia to nie wszystko. Mamy
            też <span class="magical-text">potężne zaplecze techniczne</span>, żeby tę wizję zasilić. Przekuwamy pomysły
            w rzeczywistość za pomocą najwyższej jakości dźwięku, światła, autorskiego videomappingu i zaangażowanych
            aktorów.</p>

        <div class="pull-quote">Nieważne, czy oddasz nam w ręce średniowieczny zamek, czy surową halę. Zrobimy z tego
            wydarzenie, o którym będzie się mówić.</div>

        <h2>Technika, która nie rzuca się w oczy, ale wyrywa z butów</h2>
        <p>Zapomnijcie o plątaninie kabli, smutnych panach za konsoletą i standardowych, bezdusznych ustawieniach.
            Technika sceniczna to dla nas nie cel sam w sobie, ale <strong>potężne narzędzie do tkania emocji</strong> i
            budowania klimatu. Dajemy Wam dźwięk, który czuć w klatce piersiowej, hipnotyzujące światło i obraz, który
            zaciera granice rzeczywistości.</p>

        <div style="display: flex; gap: 40px; flex-wrap: wrap; align-items: flex-start; margin: 3rem 0;">
            <div style="flex: 1; min-width: 280px;">
                <h2>Światło i lasery: szyjemy na miarę</h2>
                <p>Nie odtwarzamy gotowców z pendrive'a. Tworzymy <strong>w pełni autorskie pokazy świetlne i
                        laserowe</strong>. Synchronizujemy je co do ułamka sekundy z muzyką, scenariuszem i – co
                    najważniejsze – z unikalnym duchem miejsca. Wyciągamy z mroku zamkowe dziedzińce, ruiny i fasady,
                    nadając im zupełnie nowy wymiar.</p>

                <h2>Videomapping w trybie turbo</h2>
                <p><span class="magical-text">Ożywianie budynków</span> to nasza supermoc. Opracowaliśmy własną,
                    ekspresową technikę „zdejmowania miary” z obiektów. Dzięki temu błyskawicznie tworzymy cyfrową mapę
                    architektury, a nasi animatorzy przygotowują wizualizacje, które idealnie oplatają każdą cegłę i
                    wieżę. Żadnych płaskich obrazków – zamieniamy budynki w <strong>tętniące życiem płótna malowane
                        światłem</strong>.</p>
            </div>
            <div style="flex: 0 0 340px;">
                <?php
                $photos = glob('assets/EventPhotos/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
                if ($photos) {
                    $src = str_replace('assets/', '', $photos[array_rand($photos)]);
                    echo '<img src="image.php?src=' . urlencode($src) . '&w=600&h=400&crop=1" alt="Technika sceniczna" style="width:100%; border-radius:12px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); border: 1px solid var(--border-color);">';
                }
                ?>
            </div>
        </div>

        <h2>Potężne brzmienie i konstrukcje <span
                style="font-weight: 400; font-size: 0.85em; color: var(--text-muted);">(bez potykania się o
                kable)</span></h2>
        <p>Nasz arsenał pozwala nam na bardzo elastyczne działanie. Jesteśmy w stanie nagłośnić <strong>jedną dużą
                scenę</strong> dla pełnego, wymagającego zespołu na żywo – mamy wszystko: cyfrowe miksery estradowe,
            mikrofony instrumentalne, <strong>systemy douszne IEM</strong> i monitory <strong>P-16</strong>. Do tego
            dorzucamy dwa mniejsze sety – idealne pod DJ-a, prelekcje czy strefy chilloutu.</p>
        <p>Stawiamy własne, solidne <strong>konstrukcje z kratownic (trussów)</strong>, z których budujemy wieże
            oświetleniowe i dźwiękowe, żeby równomiernie pokryć nawet rozległy teren. A najlepsze? Wypuściliśmy technikę
            ze smyczy. Większość naszego sprzętu odbiera sygnał <strong>bezprzewodowo</strong>. Potrzebujemy tylko
            zasilania – reszta leci w eterze, więc przestrzeń pozostaje czysta i bezpieczna, bez kilometrów kabli pod
            nogami.</p>

        <h2>Z własną elektrownią <span style="font-weight: 400; font-size: 0.85em; color: var(--text-muted);">(bo zamki
                bywają kapryśne)</span></h2>
        <p>Wiemy, że instalacje elektryczne w historycznych obiektach potrafią żyć własnym życiem. Dlatego wozimy ze
            sobą serce naszego systemu: <strong>własną rozdzielnię prądową</strong> z zaawansowanymi zabezpieczeniami.
            Nie ufamy przypadkowym gniazdkom. Sami dbamy o bezpieczeństwo Wasze i nasze, gwarantując, że w kulminacyjnym
            momencie eventu <span class="magical-text">nie zgaśnie Wam światło</span>.</p>

        <h2>Live Streaming i PPV: teleportujemy Twój event w świat</h2>
        <p>Robimy streamy, które naprawdę chce się oglądać – ubrane w atrakcyjną, profesjonalną warstwę wizualną.
            Chcecie ściągnąć prelegenta z drugiego końca świata? Puszczać na żywo pytania z internetu na telebimie?
            <strong>Żaden problem.</strong> Realizujemy otwarte transmisje, ale też zamknięte wydarzenia premium.</p>
        <p>Co ważne – posiadamy <strong>własny system biletowy Pay-Per-View</strong>. Dostajecie od nas w pełni gotowe
            narzędzie do monetyzacji Waszego wydarzenia online.</p>

        <div style="margin-top: 60px; text-align: center;">
            <a href="kontakt" class="cta-button primary">Zapytaj o ofertę techniczną</a>
        </div>
    </section>
</main>

<?php require_once 'footer.php'; ?>