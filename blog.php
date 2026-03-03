<?php require_once 'header.php'; ?>

<main class="page-wrapper">
    <section class="subpage-hero">
        <h1 class="subpage-title">Blog <span class="magical-text">LegacyEvents</span></h1>
        <p class="subpage-subtitle">Kuluarowe historie zza sceny, inspiracje branżowe, poradniki dla organizatorów i
            aktualności ze świata magii.</p>
    </section>

    <section class="content-section">
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 40px;">
            <?php
            // Symulacja wpisów na blogu - normalnie z DB
            $posts = [
                ['title' => 'Jak zorganizować grę terenową dla 500 osób?', 'date' => '24 Października 2025', 'excerpt' => 'Zastanawiasz się nad angażującą integracją firmową w plenerze? Sprawdź nasze case study z Twierdzy Srebrna Góra.'],
                ['title' => 'Nowy sprzęt oświetleniowy w naszym magazynie!', 'date' => '15 Września 2025', 'excerpt' => 'Inwestujemy w najnowsze głowice ruchome LED. Co to oznacza dla Twojego wydarzenia koncertowego?'],
                ['title' => 'Sekrety charakteryzacji na Akademii Magii', 'date' => '02 Września 2025', 'excerpt' => 'Zobacz, jak od kuchni wygląda proces zamieniania naszych aktorów w mroczne istoty, elfy i czarodziejów.'],
                ['title' => 'Dlaczego wideomapping zmienia oblicze eventów?', 'date' => '11 Sierpnia 2025', 'excerpt' => 'Zwykłe oświetlenie elewacji to melodia przeszłości. Dziś budynki ożywają. Prezentujemy koszty i efekty.']
            ];

            $photos = glob('assets/EventPhotos/*.{jpg,jpeg,png,webp}', GLOB_BRACE);

            foreach ($posts as $index => $post) {
                $img = 'Logo/legacyevents_transparent.png'; // fallback
                if (isset($photos[$index])) {
                    $img = str_replace('assets/', '', $photos[$index]);
                }

                echo '<article style="background: var(--card-bg); border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden; transition: transform 0.3s;" onmouseover="this.style.transform=\'translateY(-5px)\'; this.style.borderColor=\'var(--primary-color)\'" onmouseout="this.style.transform=\'translateY(0)\'; this.style.borderColor=\'var(--border-color)\'">';
                echo '<div style="height: 200px; overflow: hidden;">';
                echo '<img src="image.php?src=' . urlencode($img) . '&w=400&h=200&crop=1" alt="Blog Image" style="width: 100%; height: 100%; object-fit: cover;">';
                echo '</div>';
                echo '<div style="padding: 25px;">';
                echo '<span style="color: var(--primary-color); font-size: 0.9rem; font-weight: 600;">' . $post['date'] . '</span>';
                echo '<h3 style="font-family: var(--font-heading); color: #fff; font-size: 1.4rem; margin: 10px 0;">' . $post['title'] . '</h3>';
                echo '<p style="color: var(--text-muted); line-height: 1.6; margin-bottom: 20px;">' . $post['excerpt'] . '</p>';
                echo '<a href="#" style="color: #fff; font-weight: 600; text-decoration: underline; text-decoration-color: var(--primary-color);">Czytaj więcej</a>';
                echo '</div>';
                echo '</article>';
            }
            ?>
        </div>

        <div style="margin-top: 50px; text-align: center;">
            <a href="#" class="cta-button secondary">Więcej Wpisów</a>
        </div>
    </section>
</main>

<?php require_once 'footer.php'; ?>