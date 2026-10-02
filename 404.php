<?php
http_response_code(404);
require_once 'header.php';
?>

<main class="page-wrapper">
    <section class="subpage-hero">
        <h1 class="subpage-title">Ta ścieżka <span class="magical-text">prowadzi donikąd</span></h1>
        <p class="subpage-subtitle">Strona, której szukasz, nie istnieje lub została przeniesiona.</p>
        <div style="margin-top: 40px;">
            <a href="/" class="cta-button primary">Wróć na stronę główną</a>
            <a href="/oferta" class="cta-button secondary">Zobacz ofertę</a>
        </div>
    </section>
</main>

<?php require_once 'footer.php'; ?>
