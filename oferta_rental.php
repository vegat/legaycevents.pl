<?php
$seo_title = "Wynajem Sprzętu Eventowego | LegacyEvents";
$seo_description = "Wypożyczalnia sprzętu estradowego, oświetleniowego i nagłośnieniowego. Sprzęt najwyższej klasy na Twój event.";
ob_start(); ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Wynajem Sprzętu Eventowego",
  "provider": { "@type": "LocalBusiness", "name": "LegacyEvents" },
  "description": "Wypożyczalnia sprzętu estradowego, oświetleniowego i nagłośnieniowego. Sprzęt najwyższej klasy na Twój event."
}
</script>
<?php $seo_schema = ob_get_clean();
require_once 'header.php';
require_once 'oferta_config.php';
$cat = $oferta_config['rental'];
?>

<main class="page-wrapper">
    <section class="subpage-hero-with-bg">
        <img src="<?php echo htmlspecialchars($cat['image']); ?>" alt="Background" class="subpage-hero-bg">
        <div class="subpage-hero-content">
            <h1 class="subpage-title">Rental <span class="magical-text">Sprzętu</span></h1>
            <p class="subpage-subtitle">Niezawodność w rozsądnej cenie. Dysponujemy ogromnym zapleczem własnym, z
                którego
                możesz skorzystać organizując własne wydarzenie.</p>
        </div>
    </section>

    <section class="content-section text-content">
        <div style="display: flex; gap: 40px; flex-wrap: wrap; flex-direction: row-reverse;">
            <div style="flex: 1; min-width: 300px;">
                <h2>Namioty i infrastruktura</h2>
                <p>Oferujemy wynajem luksusowych i wytrzymałych namiotów eventowych, mebli (stoły, krzesła, bary
                    podświetlane) oraz eleganckich dodatków (obrusy, girlandy świetlne).</p>

                <h2>Technika do ręki</h2>
                <p>Wypożyczalnia mniejszych zestawów nagłośnieniowych, mikrofonów bezprzewodowych, oświetlenia żarowego
                    i LED, dymownic oraz wytwornic ciężkiego dymu czy iskier (Sparkulary).</p>

                <h2>Dry Hire vs pełen montaż</h2>
                <p>Odbierz sprzęt z naszego magazynu i rozstaw go sam (Dry Hire) lub zaufaj nam i pozwól naszej ekipie
                    dowieźć, rozłożyć, obsłużyć i zdemontować wszystko po zakończonym evencie.</p>
            </div>
            <div style="flex: 1; min-width: 300px;">
                <?php
                $photos = glob('assets/EventPhotos/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
                if ($photos) {
                    $rand_photo = $photos[array_rand($photos)];
                    $src = str_replace('assets/', '', $rand_photo);
                    $alt = !empty($graphics_seo[$rand_photo]['alt']) ? htmlspecialchars($graphics_seo[$rand_photo]['alt']) : 'Wynajem sprzętu eventowego';
                    $title_attr = !empty($graphics_seo[$rand_photo]['title']) ? 'title="' . htmlspecialchars($graphics_seo[$rand_photo]['title']) . '"' : '';
                    echo '<img src="image.php?src=' . urlencode($src) . '&w=600&h=600&crop=1" alt="' . $alt . '" ' . $title_attr . ' style="width:100%; border-radius:12px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">';
                }
                ?>
            </div>
        </div>

        <div style="margin-top: 60px; text-align: center;">
            <a href="kontakt" class="cta-button primary">Cennik Wynajmu</a>
            <a href="oferta" class="cta-button secondary">Wróć do Oferty</a>
        </div>
    </section>
</main>

<?php require_once 'footer.php'; ?>