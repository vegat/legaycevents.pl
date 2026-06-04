<?php
$seo_title = "Realizacja Koncertów | LegacyEvents";
$seo_description = "Kompleksowa obsługa techniczna i nagłośnieniowa koncertów. Zadbamy o perfekcyjny dźwięk i światło.";
ob_start(); ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Realizacja Koncertów",
  "provider": { "@type": "LocalBusiness", "name": "LegacyEvents" },
  "description": "Kompleksowa obsługa techniczna i nagłośnieniowa koncertów. Zadbamy o perfekcyjny dźwięk i światło."
}
</script>
<?php $seo_schema = ob_get_clean();
require_once 'header.php';
require_once 'oferta_config.php';
$cat = $oferta_config['koncerty'];
?>

<main class="page-wrapper">
    <section class="subpage-hero-with-bg">
        <img src="<?php echo htmlspecialchars($cat['image']); ?>" alt="Background" class="subpage-hero-bg">
        <div class="subpage-hero-content">
            <h1 class="subpage-title">Realizacja <span class="magical-text">Koncertów</span></h1>
            <p class="subpage-subtitle">Niesamowite brzmienie, potężne nagłośnienie i dedykowane oświetlenie.
                Zorganizujmy wspólnie niezapomniane muzyczne wydarzenie w dowolnej lokalizacji.</p>
        </div>
    </section>

    <section class="content-section text-content">
        <div style="display: flex; gap: 40px; flex-wrap: wrap; flex-direction: row;">
            <div style="flex: 1; min-width: 300px;">
                <h2>Twój koncert w dowolnym miejscu</h2>
                <p>Niezależnie od tego, czy planujesz koncert w plenerze, czy w zamkniętym lokalu – dostarczymy pełne
                    zaplecze techniczne, które zaspokoi potrzeby nawet najbardziej wymagających artystów. Nasze
                    doświadczenie pozwala nam zaadaptować każdą przestrzeń tak, aby zapewnić najwyższą jakość dźwięku i
                    wizualnego show.</p>
                <p>Działamy na terenie całego kraju. Budujemy sceny w ruinach zamków, na leśnych polanach oraz w
                    zabytkowych wnętrzach. Jesteśmy otwarci na wszelkie gatunki muzyczne, od folku i muzyki
                    alternatywnej, przez rock i blues, po elektronikę, ambient i chillbeats.</p>

                <h2>Dobre nagłośnienie to podstawa</h2>
                <p>Dysponujemy potężnym nagłośnieniem o łącznej mocy <strong>ponad 6kW+</strong>, gwarantującym czyste
                    brzmienie i odpowiednie ciśnienie akustyczne. Nasze systemy obejmują m.in. topy V-Tone i Turbosound
                    oraz potężną sekcję niskotonową na bazie subwooferów The Box Piryt i Turbosound.</p>
                <p>Realizację FOH i MON prowadzimy na uznanych cyfrowych konsoletach, w tym na 32-kanałowym
                    <strong>Behringer X32 WiFi</strong> z wykorzystaniem Stage Boxów. System w pełni wspiera protokół
                    <strong>ULTRANET</strong>, co pozwala na natywną integrację np. z mikserami osobistymi P-16.
                </p>

                <h2>Rozbudowany system odsłuchowy i mikrofony</h2>
                <p>Wiemy jak ważny jest komfort muzyków na scenie. Oferujemy do 6 niezależnych torów odsłuchowych.
                    Posiadamy na wyposażeniu 4 klasyczne monitory podłogowe oraz <strong>systemy douszne IEM</strong> (4
                    kanały, w tym podział na odbiorniki).</p>
                <p>Do dyspozycji zespołów oddajemy szeroki arsenał mikrofonów, ze standardami takimi jak <strong>Shure
                        SM58</strong> i <strong>SM57</strong>, bezprzewodowymi systemami DNA Vocals, dedykowanymi
                    zestawami do nagłaśniania perkusji (Behringer BC1500) oraz mikrofonami klipsowymi do dęciaków i
                    smyków. Oczywiście z pełnym osprzętem – statywami, aktywnymi diboxami i masą okablowania.</p>
            </div>

            <div style="flex: 1; min-width: 300px;">
                <h2>Profesjonalne światło sceniczne</h2>
                <p>Wygląd sceny jest dla nas równie ważny co jej brzmienie. Nasz park maszynowy pozwala na zbudowanie
                    pełnego koncertowego klimatu:</p>
                <ul>
                    <li>Dynamiczne <strong>Głowy Ruchome</strong> (Beam 200W, Spot 200W, Wash RGBW)</li>
                    <li>Szerokie oświetlenie sceny dzięki zestawom <strong>PAR RGBW</strong> (ponad 20 sztuk)</li>
                    <li>Mocne akcenty świetlne z wykorzystaniem urządzeń <strong>Blinder/Wash 200W</strong></li>
                    <li>Unikalny klimat dzięki <strong>oświetleniu dekoracyjnemu</strong> (żarówki retro DMX)</li>
                    <li>Efekty dymne o dużej mocy wspierane podświetleniem (wyrzutnie RGB 2000W)</li>
                </ul>
                <p>Całość sterowana zaawansowanymi protokołami <strong>DMX / ArtNet</strong> z bogatą biblioteką
                    przygotowanych scen. Dajemy Wam także możliwość samodzielnego sterowania oświetleniem w standardzie
                    ARTNET, dając Wam i waszym realizatorom pełnię swobody twórczej.</p>

                <h2>Audio i wideo z Koncertu</h2>
                <p>To co ulotne warto zachować na dłużej. Z chęcią zrealizujemy profesjonalny zapis wideo/audio –
                    rejestrując wielośladowy materiał dźwiękowy na mikserze FOH, połączony z materiałem nagranym
                    kamerami z wielu perspektyw podczas trwania eventu.</p>

                <div
                    style="margin-top: 40px; text-align: center; background: rgba(0,0,0,0.5); padding: 30px; border-radius: 12px; border: 1px solid var(--accent-light);">
                    <h3 style="margin-top: 0; color: var(--accent-color);">Masz pytania o Rider Techniczny?</h3>
                    <p style="font-size: 0.9em; margin-bottom: 20px;">Nasi akustycy pomogą Wam dostroić nasz sprzęt pod
                        Wasze wymagania sprzętowe, bez względu na wielkość Waszego składu.</p>
                    <a href="kontakt" class="cta-button primary">Skontaktuj się z Nami</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Rider Techniczny -->
    <section class="content-section" style="max-width: 1400px;">
        <div style="text-align: center; margin-bottom: 60px;">
            <h2 class="section-title"
                style="font-family: 'Caveat', cursive; font-size: 3.5rem; font-weight: 700; margin-bottom: 15px;">Rider
                techniczny</h2>
            <div
                style="width: 120px; height: 2px; background: var(--primary-color); margin: 0 auto 25px; box-shadow: 0 0 10px var(--primary-glow);">
            </div>
            <p style="color: var(--text-muted); font-size: 1.1rem; max-width: 700px; margin: 0 auto;">
                Na miejscu jest osoba, która jest pasjonatem akustyki i pomoże Wam dobrze dostroić sprzęt i PA.
            </p>
        </div>

        <div class="rider-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px;">

            <!-- FOH -->
            <div class="rider-card"
                style="background: var(--card-bg); border: 1px solid var(--border-color); border-radius: 16px; padding: 35px; transition: border-color 0.3s, box-shadow 0.3s;">
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px;">
                    <div
                        style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid rgba(138,43,226,0.3); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--secondary-color)"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                            <path d="M19.07 4.93a10 10 0 0 1 0 14.14"></path>
                            <path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                        </svg>
                    </div>
                    <h3
                        style="font-family: var(--font-heading); font-size: 1.5rem; color: var(--secondary-color); margin: 0;">
                        FOH</h3>
                </div>

                <h4
                    style="color: #fff; font-size: 0.95rem; margin-bottom: 12px; letter-spacing: 1px; text-transform: uppercase;">
                    Front:</h4>
                <ul
                    style="list-style: none; padding: 0; margin: 0 0 25px; color: var(--text-muted); font-size: 0.95rem; line-height: 2;">
                    <li>• TOP: 5x V-Tone WPX 15 700W RMS</li>
                    <li>• TOP: 2x Turbosound iQ12</li>
                    <li>• SUB: 4x The Box Piryt 212A</li>
                    <li>• SUB: 1x Turbosound iQ18</li>
                    <li>• SUB: the box pro TP 118 sub</li>
                </ul>

                <h4
                    style="color: #fff; font-size: 0.95rem; margin-bottom: 12px; letter-spacing: 1px; text-transform: uppercase;">
                    Monitory:</h4>
                <ul
                    style="list-style: none; padding: 0; margin: 0; color: var(--text-muted); font-size: 0.95rem; line-height: 2;">
                    <li>• 1x the box pro DSX 115 M</li>
                    <li>• 2x the box pro DSX 110 M</li>
                    <li>• 4x pack IEM – monitor douszny (2 kanały, 4 odbiorniki)</li>
                    <li>• Indywidualny monitor odsłuchowy P-16 Behringer Ultranet</li>
                </ul>
            </div>

            <!-- MIX -->
            <div class="rider-card"
                style="background: var(--card-bg); border: 1px solid var(--border-color); border-radius: 16px; padding: 35px; transition: border-color 0.3s, box-shadow 0.3s;">
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px;">
                    <div
                        style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid rgba(138,43,226,0.3); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--secondary-color)"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="4" y1="21" x2="4" y2="14"></line>
                            <line x1="4" y1="10" x2="4" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12" y2="3"></line>
                            <line x1="20" y1="21" x2="20" y2="16"></line>
                            <line x1="20" y1="12" x2="20" y2="3"></line>
                            <line x1="1" y1="14" x2="7" y2="14"></line>
                            <line x1="9" y1="8" x2="15" y2="8"></line>
                            <line x1="17" y1="16" x2="23" y2="16"></line>
                        </svg>
                    </div>
                    <h3
                        style="font-family: var(--font-heading); font-size: 1.5rem; color: var(--secondary-color); margin: 0;">
                        MIX</h3>
                </div>

                <ul
                    style="list-style: none; padding: 0; margin: 0 0 25px; color: var(--text-muted); font-size: 0.95rem; line-height: 2;">
                    <li>• Mikser FOH 32 kanałowy <strong style="color:#fff;">Behringer X32 WiFi</strong> (z <span
                            style="color: var(--secondary-color);">MixStation</span>)</li>
                    <li>• Mikser FOH/Mon <strong style="color:#fff;">Behringer XAir18 WiFi</strong></li>
                    <li>• Stage Box 16/8</li>
                    <li>• Kompatybilność z <strong style="color:#fff;">ULTRANET</strong> (np. z monitorami Behringer
                        P-16)</li>
                    <li>• Behringer Flow jako opcjonalny mikser monitorowy</li>
                </ul>

                <div style="border-top: 1px solid var(--border-color); padding-top: 15px;">
                    <p style="color: var(--text-muted); font-size: 0.95rem; margin: 0;">• Zapas kabli
                        XLR/instrumentalnych/jack</p>
                </div>
            </div>

            <!-- MIKROFONY -->
            <div class="rider-card"
                style="background: var(--card-bg); border: 1px solid var(--border-color); border-radius: 16px; padding: 35px; transition: border-color 0.3s, box-shadow 0.3s;">
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px;">
                    <div
                        style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid rgba(138,43,226,0.3); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--secondary-color)"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>
                            <line x1="12" y1="19" x2="12" y2="23"></line>
                            <line x1="8" y1="23" x2="16" y2="23"></line>
                        </svg>
                    </div>
                    <h3
                        style="font-family: var(--font-heading); font-size: 1.5rem; color: var(--secondary-color); margin: 0;">
                        MIKROFONY</h3>
                </div>

                <ul
                    style="list-style: none; padding: 0; margin: 0 0 25px; color: var(--text-muted); font-size: 0.95rem; line-height: 2;">
                    <li>• 2x <strong style="color:#fff;">Shure SM58</strong></li>
                    <li>• 2x <strong style="color:#fff;">Shure SM57</strong></li>
                    <li>• 4x Duomic SM57 (dynamiczne)</li>
                    <li>• 4x <strong style="color:#fff;">DNA RV-4</strong> Voc. Bezprzewodowe</li>
                    <li>• 2x DNA StageVocal nagłowne</li>
                    <li>• Zestaw mikrofonów perkusyjnych <strong style="color:#fff;">Behringer BC1500</strong></li>
                    <li>• 2x boom mic do nietypowych instrumentów</li>
                    <li>• Mikrofon klipsowy do instrumentów dętych/smyczkowych</li>
                </ul>

                <h4 style="color: #fff; font-size: 0.9rem; margin-bottom: 10px; letter-spacing: 1px;">Ponadto:</h4>
                <ul
                    style="list-style: none; padding: 0; margin: 0; color: var(--text-muted); font-size: 0.95rem; line-height: 2;">
                    <li>• 8x statywy mikrofonowy</li>
                    <li>• 2x dwukanałowy dibox aktywny</li>
                </ul>
            </div>

            <!-- ŚWIATŁO -->
            <div class="rider-card"
                style="background: var(--card-bg); border: 1px solid var(--border-color); border-radius: 16px; padding: 35px; transition: border-color 0.3s, box-shadow 0.3s;">
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px;">
                    <div
                        style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid rgba(138,43,226,0.3); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--secondary-color)"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                        </svg>
                    </div>
                    <h3
                        style="font-family: var(--font-heading); font-size: 1.5rem; color: var(--secondary-color); margin: 0;">
                        ŚWIATŁO</h3>
                </div>

                <ul
                    style="list-style: none; padding: 0; margin: 0 0 25px; color: var(--text-muted); font-size: 0.95rem; line-height: 2;">
                    <li>• 4x Głowa <strong style="color:#fff;">BEAM 200W</strong></li>
                    <li>• 8x Głowa <strong style="color:#fff;">WASH RGBW</strong></li>
                    <li>• 2x Głowa <strong style="color:#fff;">SPOT 200W</strong></li>
                    <li>• 6x Oświetlacz Architektoniczny <strong style="color:#fff;">RGBW+UV</strong> 600W</li>
                    <li>• 8x Listwa oświetleniowa RGBW <strong style="color:#fff;">400W</strong></li>
                    <li>• 2x <strong style="color:#fff;">Blinder/Wash 200W</strong></li>
                    <li>• 20x <strong style="color:#fff;">PAR RGBW</strong></li>
                    <li>• Oświetlenie dekoracyjne (żarówki retro) DMX</li>
                    <li>• 2x dymiarka efektowa (wyrzutnia dymu) <strong style="color:#fff;">2000W RGB</strong></li>
                </ul>

                <div style="border-top: 1px solid var(--border-color); padding-top: 15px;">
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0; line-height: 1.6;">
                        Wszystko sterowane po <strong style="color:#fff;">DMX/ArtNet</strong>, posiadamy sceny dla
                        QLC+/Chromateq Pro DMX 2
                    </p>
                </div>
            </div>

        </div>
    </section>
</main>

<?php require_once 'footer.php'; ?>