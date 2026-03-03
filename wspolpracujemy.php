<?php require_once 'header.php'; ?>

<main class="page-wrapper">
    <section class="subpage-hero">
        <h1 class="subpage-title">Z kim <span class="magical-text">Współpracujemy?</span></h1>
        <p class="subpage-subtitle">Poznaj nasze ulubione obiekty, zaufanych podwykonawców oraz instytucje, dzięki
            którym magia ożywa.</p>
    </section>

    <section class="content-section">
        <div style="text-align: center; margin-bottom: 50px;">
            <h2 style="font-family: var(--font-heading); font-size: 2rem;">Wybrane Obiekty i Partnerzy</h2>
            <p class="text-content">Zamki, twierdze, pałace i gminy, w których organizowaliśmy nasze największe
                wydarzenia terenowe.</p>
        </div>

        <div class="partners-grid"
            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px; text-align: left;">
            <?php
            $partners = [
                [
                    'name' => 'Grupa Teatralna Wernisaż',
                    'desc' => 'Nasza wspaniała ekipa, która zawsze tchnie magię w każde wydarzenie, bardzo przykładając się do wcielania się w role oraz do przygotowania dekoracji oraz strojów.',
                    'link' => 'https://www.facebook.com/teatrwernisaz'
                ],
                [
                    'name' => 'Corvideo - Fotografia i Wideo',
                    'desc' => 'Nasz niezastąpiony Corvideo łapie większość z pięknych kadrów, które widzicie u nas na stronie. Świetne wyczucie momentu, wprawne oko i celne fotograficzne strzały to jego wielkie zalety. Jeśli potrzebujecie fajnych zdjęć to warto się z nim skontaktować:',
                    'link' => 'https://www.facebook.com/Corvideoproductions'
                ],
                [
                    'name' => 'Zamek Świny',
                    'desc' => 'Najstarszy zamek na Śląsku, którego surowe gotyckie mury idealnie wpisują się w nasze mroczne i immersyjne scenariusze.',
                    'link' => 'https://www.facebook.com/zamek.swiny.schweinichen'
                ],
                [
                    'name' => 'Zamek Ząbkowice Śląskie',
                    'desc' => 'Tajemnicze ruiny zamku z podwójnymi scianami dziedzińca, będące doskonałym tłem dla każdego wydarzenia.'
                ],
                [
                    'name' => 'Zamek Bolków',
                    'desc' => 'Majestatyczna twierdza, która regularnie ożywa podczas naszych rycerskich questów i cyberpunkowych festiwali.',
                    'link' => 'https://www.facebook.com/muzeum.zamek.bolkow'
                ],
                [
                    'name' => 'Zamek Międzyrzecz',
                    'desc' => 'Wyjątkowy zabytkowy zamek o pięknym, zielonym dziedzińcu, z którym współpracujemy przy tworzeniu unikalnych i wciągających narracji terenowych.'
                ],
                [
                    'name' => 'Stara Podkowa',
                    'desc' => 'Urokliwe miejsce pełne rustykalnego klimatu, wspierające nasze wydarzenia bazą noclegową i gastronomiczną.',
                    'link' => 'https://www.facebook.com/starapodkowa'
                ]
            ];

            foreach ($partners as $partner) {
                echo '<div class="event-card" style="min-height: 200px; display: flex; flex-direction: column; justify-content: space-between;">';
                echo '<div>';
                echo '<div class="card-glow"></div>';
                echo '<h3>' . $partner['name'] . '</h3>';
                echo '<p>' . $partner['desc'] . '</p>';
                echo '</div>';
                if (isset($partner['link'])) {
                    echo '<div style="margin-top: 15px;">';
                    echo '<a href="' . $partner['link'] . '" target="_blank" class="cta-button primary" style="display: inline-block;">Odwiedź stronę</a>';
                    echo '</div>';
                }
                echo '</div>';
            }
            ?>
        </div>

        <div style="margin-top: 80px; text-align: center;" class="text-content">
            <h3>Chcesz dołączyć do tego grona?</h3>
            <p>Jesteś właścicielem interesującego obiektu lub agencją poszukującą kreatywnego partnera?</p>
            <a href="kontakt" class="cta-button primary" style="margin-top: 20px;">Napisz do nas</a>
        </div>
    </section>
</main>

<?php require_once 'footer.php'; ?>