<?php
$seo_title = "Dmuchane Zamki i Atrakcje | LegacyEvents";
$seo_description = "Wynajem dmuchanych zamków, zjeżdżalni i atrakcji plenerowych dla dzieci i dorosłych.";
ob_start(); ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Dmuchane Zamki i Atrakcje",
  "provider": { "@type": "LocalBusiness", "name": "LegacyEvents" },
  "description": "Wynajem dmuchanych zamków, zjeżdżalni i atrakcji plenerowych dla dzieci i dorosłych."
}
</script>
<?php $seo_schema = ob_get_clean();
require_once 'header.php';

// Konfiguracja sekcji "Zaufali Nam" - lista zamków, plików wideo i linków
$partner_castles = [
    [
        'name' => 'Zamek Bolków',
        'video' => 'assets/Video/bolkow.mp4',
        'link' => 'https://zamek-bolkow.info.pl/'
    ],
    [
        'name' => 'Zamek Świny',
        'video' => 'assets/Video/swiny.mp4',
        'link' => 'https://zamekswiny.pl/'
    ],
    [
        'name' => 'Zamek w<br>Ząbkowicach Śląskich',
        'video' => 'assets/Video/zabkowice.mp4',
        'link' => 'https://zamek.zabkowiceslaskie.pl/'
    ],
    [
        'name' => 'Zamek w<br>Międzyrzeczu',
        'video' => 'assets/Video/miedzyrzecz.mp4',
        'link' => 'https://muzeum-miedzyrzecz.pl/'
    ],
    [
        'name' => 'Zamek w Czersku',
        'video' => 'assets/Video/czersk.mp4',
        'link' => 'https://zamekczersk.pl/'
    ]
];
?>

<main class="page-wrapper castle-landing">
    <section class="subpage-hero-with-bg"
        style="min-height: 70vh; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
        <!-- Tło Wideo z efektem Duotone -->
        <div
            style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 0; background-color: var(--bg-color);">
            <video src="assets/Video/castlebg.mp4" autoplay loop muted playsinline
                style="width: 100%; height: 100%; object-fit: cover; filter: grayscale(100%) sepia(100%) hue-rotate(220deg) saturate(250%) contrast(1.2) brightness(0.5); opacity: 0.8;"></video>
            <div
                style="position: absolute; bottom: 0; left: 0; right: 0; height: 150px; background: linear-gradient(to top, var(--bg-color) 0%, transparent 100%); z-index: 1;">
            </div>
        </div>

        <div class="subpage-hero-content" style="text-align: center; position: relative; z-index: 2; padding: 40px;">
            <div style="margin-bottom: 25px; line-height: 1;">
                <img src="assets/ico/castle.webp" alt="Zamek"
                    style="height: 120px; filter: drop-shadow(0 0 25px rgba(180, 140, 255, 0.8)); transition: transform 0.3s ease;"
                    onmouseover="this.style.transform='scale(1.1) translateY(-5px)'"
                    onmouseout="this.style.transform='scale(1) translateY(0)'">
            </div>
            <h1 class="subpage-title"
                style="font-size: 4rem; text-transform: uppercase; letter-spacing: 3px; font-weight: 700; text-shadow: 0 5px 20px rgba(0,0,0,0.8);">
                Przebudź <span class="magical-text">Mury</span></h1>
            <p class="subpage-subtitle"
                style="font-size: 1.5rem; max-width: 800px; margin: 0 auto; text-shadow: 0 2px 10px rgba(0,0,0,0.8);">
                Oferta współpracy dla właścicieli, zarządców i wizjonerów dbających o promocję zamków oraz obiektów
                historycznych.</p>
        </div>
    </section>

    <section class="content-section text-content">
        <p class="lead" style="text-align: center; font-size: 1.8rem; margin-bottom: 60px; color: #fff;">
            Koniec z kolejnymi, takimi samymi piknikami historycznymi.<br>
            <span class="magical-text">Czas na wydarzenia, które zapierają dech w piersiach.</span>
        </p>

        <!-- Sekcja 1 -->
        <div style="display: flex; gap: 50px; flex-wrap: wrap; align-items: center; margin: 6rem 0;">
            <div style="flex: 1; min-width: 300px;">
                <h2 style="font-size: 2.8rem; margin-bottom: 1.5rem;">Infrastruktura z <span
                        class="magical-text">niczego</span></h2>
                <p style="font-size: 1.1rem; line-height: 1.8; color: var(--text-color);">Twój zamek to zachwycające,
                    ale surowe ruiny bez dostępu do prądu? Dla nas to żaden problem. <strong>Budujemy infrastrukturę od
                        zera.</strong> Zapewniamy w pełni bezpieczne i stabilne zasilanie, które bez zająknięcia obsłuży
                    potężne sceny, profesjonalne nagłośnienie, oświetlenie estradowe i spektakularne efekty specjalne na
                    terenie całego obiektu.</p>
            </div>
            <div style="flex: 1; min-width: 300px; text-align: center; position: relative;">
                <div
                    style="position: absolute; top: -20px; left: -20px; right: 20px; bottom: 20px; border: 2px solid var(--primary-color); border-radius: 12px; z-index: 0; opacity: 0.3;">
                </div>
                <!-- Obrazek sprzętu w ruinach -->
                <img src="assets/img/rozdzielnia-legacy.webp" alt="Infrastruktura eventowa na zamku"
                    style="width:100%; position: relative; z-index: 1; border-radius:12px; box-shadow: 0 15px 40px rgba(0,0,0,0.6);">
            </div>
        </div>

        <!-- Sekcja 2 -->
        <div style="display: flex; gap: 50px; flex-wrap: wrap-reverse; align-items: center; margin: 6rem 0;">
            <div style="flex: 1; min-width: 300px; text-align: center; position: relative;">
                <div
                    style="position: absolute; top: -20px; right: -20px; left: 20px; bottom: 20px; border: 2px solid var(--primary-color); border-radius: 12px; z-index: 0; opacity: 0.3;">
                </div>
                <!-- Obrazek nietypowego eventu -->
                <img src="assets/img/nietypowy-event.webp"
                    alt="Kreatywne wydarzenie na zamku"
                    style="width:100%; position: relative; z-index: 1; border-radius:12px; box-shadow: 0 15px 40px rgba(0,0,0,0.6);">
            </div>
            <div style="flex: 1; min-width: 300px;">
                <h2 style="font-size: 2.8rem; margin-bottom: 1.5rem;">Nowe spojrzenie. <span
                        class="magical-text">Odważne tematy.</span></h2>
                <p style="font-size: 1.1rem; line-height: 1.8; color: var(--text-color);">Kreatywnie adaptujemy
                    przestrzeń. Zamiast powielać utarte schematy, patrzymy na Twój obiekt świeżym okiem. Organizujemy
                    wydarzenia tematyczne opierając się na klasykach, które kochają widzowie – <strong>smoki, rycerze,
                        średniowiecze, magia i święta</strong>.</p>
                <p style="font-size: 1.1rem; line-height: 1.8; color: var(--text-color);">Ale idziemy też o krok dalej.
                    Wprowadzamy do zamków motywy, których nikt się nie spodziewa: <strong>festiwale futurystyczne,
                        widowiska muzyczne czy angażujące śledztwa detektywistyczne</strong>. Ożywiamy przestrzeń,
                    przyciągając zupełnie nowe grupy odbiorców.</p>
            </div>
        </div>

        <div class="pull-quote"
            style="border-left: 4px solid var(--primary-color); padding-left: 30px; margin: 5rem 0; background: linear-gradient(90deg, rgba(180, 140, 255, 0.1) 0%, transparent 100%); padding-top: 20px; padding-bottom: 20px; border-radius: 0 12px 12px 0;">
            Od A do Z. Wchodzimy, budujemy magię, sprzątamy. Od zamku potrzebujemy tylko kluczy i informacji o dostępie
            do prądu czy wody. Ale z równą pasją <strong>wchodzimy w partnerstwa</strong> przy wydarzeniach, które
            zaplanowałeś jako zarządca obiektu.
        </div>

        <!-- Sekcja 3 - Boxy -->
        <div style="margin: 6rem 0;">
            <h2 style="text-align: center; margin-bottom: 3rem; font-size: 2.8rem;">Zabawa, nie "patrzysko"</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                <div class="event-card"
                    style="padding: 40px 30px; text-align: center; background: rgba(0,0,0,0.3); border: 1px solid var(--border-color); border-radius: 16px; transition: transform 0.3s ease, border-color 0.3s ease;">
                    <div style="margin-bottom: 20px;">
                        <img src="assets/ico/sword.webp" alt="Gry i Rywalizacja" style="height: 65px; filter: drop-shadow(0 0 15px var(--primary-color)); transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px; color: #fff;">Gry i Rywalizacja</h3>
                    <p style="color: var(--text-muted); line-height: 1.6;">U nas nikt nie stoi z boku. Tworzymy
                        angażujące scenariusze, dzielimy uczestników na drużyny i wprowadzamy zdrową, fabularną
                        rywalizację. Odwiedzający stają się bohaterami.</p>
                </div>
                <div class="event-card"
                    style="padding: 40px 30px; text-align: center; background: rgba(0,0,0,0.3); border: 1px solid var(--border-color); border-radius: 16px; transition: transform 0.3s ease, border-color 0.3s ease;">
                    <div style="margin-bottom: 20px;">
                        <img src="assets/ico/no-phone.webp" alt="Detoks Cyfrowy" style="height: 65px; filter: drop-shadow(0 0 15px var(--primary-color)); transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px; color: #fff;">Detoks Cyfrowy</h3>
                    <p style="color: var(--text-muted); line-height: 1.6;">Unikamy "tabletozy". Ekrany ograniczamy do
                        minimum. Technologia ma budować doświadczenie, a nie wyrywać z niego. A gdy trzeba – stawiamy
                        własne WiFi sięgające do zamkowych podziemi.</p>
                </div>
                <div class="event-card"
                    style="padding: 40px 30px; text-align: center; background: rgba(0,0,0,0.3); border: 1px solid var(--border-color); border-radius: 16px; transition: transform 0.3s ease, border-color 0.3s ease;">
                    <div style="font-size: 3.5rem; margin-bottom: 20px; text-shadow: 0 0 20px var(--primary-color);">🎟️
                    </div>
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px; color: #fff;">Własna Bileteria</h3>
                    <p style="color: var(--text-muted); line-height: 1.6;">Posiadamy autorski, bezpieczny system
                        biletowy. Eliminujemy pośredników i sami opiekujemy się klientem od pierwszego kliknięcia, aż po
                        radosne przekroczenie bramy zamku.</p>
                </div>
            </div>
        </div>

        <!-- EKG ZAMKOWE -->
        <section class="castle-ecg-section" style="width: 100vw; margin: 8rem 0; margin-left: calc(-50vw + 50%); position: relative; padding: 120px 0; background: linear-gradient(to bottom, transparent, rgba(10,10,15,0.8) 20%, rgba(10,10,15,0.8) 80%, transparent); overflow: hidden; display: flex; flex-direction: column; align-items: center; justify-content: center;">
            <h2 style="text-align: center; font-size: 3rem; margin-bottom: 20px; color: #fff; text-shadow: 0 0 20px rgba(180, 140, 255, 0.4);">Zamki z nami <span class="magical-text">żyją</span></h2>
            <p style="color: var(--text-muted); font-size: 1.2rem; margin-bottom: 60px; text-align: center; max-width: 600px;">Pulsująca energia naszych wydarzeń budzi historię zapisaną w tych murach.</p>
            
            <div style="width: 100%; max-width: 1200px; height: 200px; position: relative; -webkit-mask-image: linear-gradient(90deg, transparent 0%, black 15%, black 85%, transparent 100%); mask-image: linear-gradient(90deg, transparent 0%, black 15%, black 85%, transparent 100%);">
                <!-- Tło dla ścieżki (zgaszone) -->
                <svg viewBox="0 0 1000 200" preserveAspectRatio="xMidYMid meet" style="width: 100%; height: 100%; position: absolute; top: 0; left: 0;">
                    <path d="M 0 150 L 260 150 L 265 110 L 295 110 L 300 150 L 340 150 L 345 110 L 375 110 L 380 150 L 420 150 L 425 50 L 435 50 L 435 70 L 455 70 L 455 50 L 475 50 L 480 150 L 510 150 L 520 90 L 560 90 L 570 150 L 600 150 L 605 50 L 625 50 L 625 70 L 645 70 L 645 50 L 655 50 L 660 150 L 700 150 L 705 110 L 735 110 L 740 150 L 780 150 L 785 110 L 815 110 L 820 150 L 1000 150" 
                          stroke="rgba(180, 140, 255, 0.15)" stroke-width="4" fill="none" stroke-linejoin="round" stroke-linecap="round" />
                </svg>

                <!-- Aktywna linia (biegnąca) -->
                <svg viewBox="0 0 1000 200" preserveAspectRatio="xMidYMid meet" style="width: 100%; height: 100%; position: absolute; top: 0; left: 0; filter: drop-shadow(0 0 15px var(--primary-color)) drop-shadow(0 0 30px var(--primary-color));">
                    <path class="ecg-glow-path trail-3" d="M 0 150 L 260 150 L 265 110 L 295 110 L 300 150 L 340 150 L 345 110 L 375 110 L 380 150 L 420 150 L 425 50 L 435 50 L 435 70 L 455 70 L 455 50 L 475 50 L 480 150 L 510 150 L 520 90 L 560 90 L 570 150 L 600 150 L 605 50 L 625 50 L 625 70 L 645 70 L 645 50 L 655 50 L 660 150 L 700 150 L 705 110 L 735 110 L 740 150 L 780 150 L 785 110 L 815 110 L 820 150 L 1000 150" pathLength="1000" />
                    <path class="ecg-glow-path trail-2" d="M 0 150 L 260 150 L 265 110 L 295 110 L 300 150 L 340 150 L 345 110 L 375 110 L 380 150 L 420 150 L 425 50 L 435 50 L 435 70 L 455 70 L 455 50 L 475 50 L 480 150 L 510 150 L 520 90 L 560 90 L 570 150 L 600 150 L 605 50 L 625 50 L 625 70 L 645 70 L 645 50 L 655 50 L 660 150 L 700 150 L 705 110 L 735 110 L 740 150 L 780 150 L 785 110 L 815 110 L 820 150 L 1000 150" pathLength="1000" />
                    <path class="ecg-glow-path trail-1" d="M 0 150 L 260 150 L 265 110 L 295 110 L 300 150 L 340 150 L 345 110 L 375 110 L 380 150 L 420 150 L 425 50 L 435 50 L 435 70 L 455 70 L 455 50 L 475 50 L 480 150 L 510 150 L 520 90 L 560 90 L 570 150 L 600 150 L 605 50 L 625 50 L 625 70 L 645 70 L 645 50 L 655 50 L 660 150 L 700 150 L 705 110 L 735 110 L 740 150 L 780 150 L 785 110 L 815 110 L 820 150 L 1000 150" pathLength="1000" />
                    <path class="ecg-glow-path head" d="M 0 150 L 260 150 L 265 110 L 295 110 L 300 150 L 340 150 L 345 110 L 375 110 L 380 150 L 420 150 L 425 50 L 435 50 L 435 70 L 455 70 L 455 50 L 475 50 L 480 150 L 510 150 L 520 90 L 560 90 L 570 150 L 600 150 L 605 50 L 625 50 L 625 70 L 645 70 L 645 50 L 655 50 L 660 150 L 700 150 L 705 110 L 735 110 L 740 150 L 780 150 L 785 110 L 815 110 L 820 150 L 1000 150" pathLength="1000" />
                </svg>
            </div>
        </section>

        <!-- TECHNOLOGIE I APLIKACJE -->
        <h2 style="text-align: center; margin-top: 8rem; font-size: 2.8rem;">Technologia w Służbie Obiektu</h2>
        <p style="text-align: center; margin-bottom: 4rem; font-size: 1.2rem; color: var(--text-muted);">Nie tylko
            eventy – dostarczamy autorskie rozwiązania, które zostają z Twoim zamkiem na dłużej i wspierają go każdego
            dnia.</p>

        <div style="display: flex; flex-direction: column; gap: 30px;">
            <!-- Notigo -->
            <div class="tech-card">
                <div class="tech-icon-wrapper">
                    <!-- [PLACEHOLDER_4] Ikona Notigo -->
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100'%3E%3Ccircle cx='50' cy='50' r='45' fill='%23333'/%3E%3Ctext x='50' y='55' dominant-baseline='middle' text-anchor='middle' font-family='sans-serif' font-size='12' fill='%23aaa'%3E%5BPLCHLDR_4%5D%3C/text%3E%3C/svg%3E"
                        alt="Notigo App" class="tech-icon">
                </div>
                <div class="tech-content">
                    <h3 style="margin-top: 0; color: var(--primary-color); font-size: 1.5rem;">Aplikacja Notigo</h3>
                    <p style="margin-bottom: 0; line-height: 1.6; color: var(--text-color);">Nasze narzędzie do
                        integracji w trakcie eventu. Pozwala uczestnikom na błyskawiczną wymianę zdjęć i opinii, bez
                        wymogu rejestracji, podawania danych czy irytujących powiadomień długo po wydarzeniu. Dajemy im
                        przestrzeń na dzielenie się magią chwili.</p>
                </div>
            </div>

            <!-- Zamky.pl -->
            <div class="tech-card">
                <div class="tech-icon-wrapper">
                    <!-- [PLACEHOLDER_5] Ikona Zamky.pl -->
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100'%3E%3Ccircle cx='50' cy='50' r='45' fill='%23333'/%3E%3Ctext x='50' y='55' dominant-baseline='middle' text-anchor='middle' font-family='sans-serif' font-size='12' fill='%23aaa'%3E%5BPLCHLDR_5%5D%3C/text%3E%3C/svg%3E"
                        alt="Zamky.pl App" class="tech-icon">
                </div>
                <div class="tech-content">
                    <h3 style="margin-top: 0; color: var(--primary-color); font-size: 1.5rem;">Platforma Zamky.pl</h3>
                    <p style="margin-bottom: 0; line-height: 1.6; color: var(--text-color);">System dla zamków,
                        pozwalający na łatwe przygotowanie interaktywnych gier terenowych na miejscu. Urozmaica
                        codzienne, "zwykłe" wizyty i zamienia standardowe zwiedzanie z przewodnikiem w fascynującą
                        przygodę dla całych rodzin.</p>
                </div>
            </div>

            <!-- HuntMap.pl -->
            <div class="tech-card">
                <div class="tech-icon-wrapper">
                    <!-- [PLACEHOLDER_6] Ikona HuntMap.pl -->
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100'%3E%3Ccircle cx='50' cy='50' r='45' fill='%23333'/%3E%3Ctext x='50' y='55' dominant-baseline='middle' text-anchor='middle' font-family='sans-serif' font-size='12' fill='%23aaa'%3E%5BPLCHLDR_6%5D%3C/text%3E%3C/svg%3E"
                        alt="HuntMap App" class="tech-icon">
                </div>
                <div class="tech-content">
                    <h3 style="margin-top: 0; color: var(--primary-color); font-size: 1.5rem;">Aplikacja HuntMap.pl</h3>
                    <p style="margin-bottom: 0; line-height: 1.6; color: var(--text-color);">Wspieramy promocję Twojego
                        obiektu wpisując go w naszą platformę gier terenowych. Tworzymy trasy regionalne, których Twój
                        zamek jest sercem. Wpisuje się to w trendy nowoczesnej turystyki i przyciąga gości nawet w dni
                        bez żadnych wydarzeń.</p>
                </div>
            </div>
        </div>

        <div
            style="margin: 6rem 0; text-align: center; background: rgba(0,0,0,0.3); padding: 50px 30px; border-radius: 16px; border: 1px solid rgba(180, 140, 255, 0.3);">
            <h3 style="font-size: 2rem; margin-bottom: 20px; color: #fff;">Wsparcie Marketingowe</h2>
                <p
                    style="font-size: 1.1rem; max-width: 800px; margin: 0 auto 30px auto; color: var(--text-muted); line-height: 1.6;">
                    Nasz Zespół Kreatywny to Twoje zbrojne ramię w promocji. Pomożemy wymyślić wydarzenie i wesprzemy
                    marketing w internecie. Dobierzemy propozycje imprez, które już sprawdziły się w przeszłości i z
                    sukcesem podbiły serca odbiorców.
                </p>
                <a href="kontakt" class="cta-button primary"
                    style="font-size: 1.2rem; padding: 15px 40px;">Porozmawiajmy o potencjale Twojego zamku</a>
        </div>
    </section>
</main>

<!-- Z KIM WSPÓŁPRACOWALIŚMY -->
<!-- Tło zamkowe w ciemnych barwach -->
<section
    style="background: url('assets/img/castlebg2.webp') center/cover fixed; position: relative; padding: 120px 20px; text-align: center; border-top: 1px solid var(--border-color);">
    <div
        style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(to bottom, var(--bg-color) 0%, rgba(10,10,15,0.4) 30%, rgba(10,10,15,0.4) 70%, var(--bg-color) 100%); z-index: 1;">
    </div>

    <div style="position: relative; z-index: 2; max-width: 1200px; margin: 0 auto;">
        <h2
            style="font-size: 3.5rem; text-transform: uppercase; letter-spacing: 3px; margin-bottom: 15px; text-shadow: 0 0 30px rgba(180, 140, 255, 0.3);">
            <span class="magical-text">Zaufali</span> Nam
        </h2>
        <p style="font-size: 1.2rem; margin-bottom: 70px; color: #ddd;">Mieliśmy zaszczyt obudzić magię na murach tych
            niesamowitych obiektów.</p>

        <div style="display: flex; flex-wrap: wrap; justify-content: center; align-items: flex-start; gap: 50px;">
            <?php foreach ($partner_castles as $castle): ?>
                <div class="castle-partner">
                    <div class="castle-video-wrapper">
                        <video src="<?php echo htmlspecialchars($castle['video']); ?>" autoplay loop muted playsinline
                            class="castle-video"></video>
                    </div>
                    <h3 class="castle-name-gothic">
                        <?php if (!empty($castle['link']) && $castle['link'] !== '#'): ?>
                            <a href="<?php echo htmlspecialchars($castle['link']); ?>" target="_blank"
                                rel="noopener noreferrer"><?php echo $castle['name']; ?></a>
                        <?php else: ?>
                            <?php echo $castle['name']; ?>
                        <?php endif; ?>
                    </h3>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
    @import url('https://fonts.googleapis.com/css2?family=MedievalSharp&display=swap');

    /* Style specyficzne dla landing page'a z zamkami */
    .castle-landing .tech-card {
        background: rgba(255, 255, 255, 0.03);
        padding: 35px;
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        display: flex;
        gap: 30px;
        align-items: center;
        flex-wrap: wrap;
        transition: background 0.3s ease, transform 0.3s ease;
    }

    .castle-landing .tech-card:hover {
        background: rgba(255, 255, 255, 0.06);
        transform: translateY(-5px);
        border-color: rgba(180, 140, 255, 0.3);
    }

    .castle-landing .tech-icon-wrapper {
        flex: 0 0 100px;
        text-align: center;
    }

    .castle-landing .tech-icon {
        width: 80px;
        border-radius: 20px;
        filter: drop-shadow(0 0 15px rgba(180, 140, 255, 0.4));
        transition: filter 0.3s ease, transform 0.3s ease;
    }

    .castle-landing .tech-card:hover .tech-icon {
        filter: drop-shadow(0 0 25px rgba(180, 140, 255, 0.8));
        transform: scale(1.05);
    }

    .castle-landing .tech-content {
        flex: 1;
        min-width: 250px;
    }

    .castle-partner {
        transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        width: 400px;
    }

    .castle-partner:hover {
        transform: translateY(-20px);
    }

    .castle-video-wrapper {
        width: 320px;
        height: 320px;
        border-radius: 50%;
        overflow: hidden;
        border: 6px solid rgba(180, 140, 255, 0.3);
        box-shadow: 0 0 30px rgba(180, 140, 255, 0.15);
        transition: box-shadow 0.5s ease, border-color 0.5s ease;
        margin: 0 auto;
        position: relative;
        background: #0a0a10;
    }

    .castle-partner:hover .castle-video-wrapper {
        box-shadow: 0 0 60px rgba(180, 140, 255, 0.7);
        border-color: var(--primary-color);
    }

    .castle-video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s ease, filter 0.8s ease;
        pointer-events: none;
        /* Domyślny efekt duotone */
        filter: grayscale(100%) sepia(100%) hue-rotate(220deg) saturate(250%) contrast(1.2) brightness(0.6);
    }

    .castle-partner:hover .castle-video {
        transform: scale(1.05);
        /* Przywrócenie kolorów po najechaniu */
        filter: grayscale(0%) sepia(0%) hue-rotate(0deg) saturate(100%) contrast(1) brightness(1);
    }

    .castle-name-gothic {
        margin-top: 35px;
        font-family: 'MedievalSharp', cursive;
        font-size: 2.2rem;
        color: #fff;
        line-height: 1.3;
        text-shadow: 0 4px 15px rgba(0, 0, 0, 1);
        letter-spacing: 2px;
    }

    .castle-name-gothic a {
        color: inherit;
        text-decoration: none;
        transition: color 0.3s ease, text-shadow 0.3s ease;
        display: inline-block;
        position: relative;
    }

    .castle-name-gothic a:hover {
        /* Efekt CC Light Rays (Shimmer/Sweep) */
        background: linear-gradient(-45deg, var(--primary-color) 40%, #fff 50%, var(--primary-color) 60%);
        background-size: 300%;
        color: transparent;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: lightSweep 2s linear infinite;
        text-shadow: none;
        filter: drop-shadow(0 0 10px rgba(180, 140, 255, 0.8));
    }

    @keyframes lightSweep {
        0% {
            background-position: 100% center;
        }

        100% {
            background-position: 0% center;
        }
    }

    /* Animacja EKG */
    .ecg-glow-path {
        stroke-linecap: round;
        stroke-linejoin: round;
        fill: none;
        animation: ecgSweep 2.5s cubic-bezier(0.4, 0, 0.2, 1) infinite;
    }

    .ecg-glow-path.head {
        stroke-dasharray: 40 1000;
        stroke-width: 6;
        stroke: #fff;
        animation-delay: -0.25s;
        filter: drop-shadow(0 0 10px #fff) drop-shadow(0 0 20px var(--primary-color));
    }
    
    .ecg-glow-path.trail-1 {
        stroke-dasharray: 60 1000;
        stroke-width: 5;
        stroke: rgba(180, 140, 255, 0.8);
        animation-delay: -0.18s;
    }

    .ecg-glow-path.trail-2 {
        stroke-dasharray: 80 1000;
        stroke-width: 4;
        stroke: rgba(180, 140, 255, 0.4);
        animation-delay: -0.09s;
    }

    .ecg-glow-path.trail-3 {
        stroke-dasharray: 120 1000;
        stroke-width: 2;
        stroke: rgba(180, 140, 255, 0.1);
        animation-delay: 0s;
    }

    @keyframes ecgSweep {
        0% { stroke-dashoffset: 120; opacity: 0; }
        5% { opacity: 1; }
        95% { opacity: 1; }
        100% { stroke-dashoffset: -1000; opacity: 0; }
    }
</style>

<?php require_once 'footer.php'; ?>