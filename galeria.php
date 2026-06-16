<?php
$seo_title = "Galeria Realizacji Eventowych | LegacyEvents";
$seo_description = "Zobacz zdjęcia z naszych najlepszych realizacji. Koncerty, pokazy, scenotechnika, animacje i wiele więcej pięknych chwil ujętych w kadrach.";
require_once 'header.php';
require_once 'galeria_config.php';
?>

<main class="page-wrapper gallery-page">
    <section class="subpage-hero">
        <h1 class="subpage-title">Nasza <span class="magical-text">Galeria</span></h1>
        <p class="subpage-subtitle">Uchwycone momenty magii i emocji z naszych wydarzeń. Zobacz, jak wyglądają światy,
            które tworzymy.</p>
    </section>

    <!-- Top Dynamic Slider -->
    <section class="gallery-slider-section">
        <div class="gallery-slider-container" id="gallerySliderContainer">
            <div class="gallery-slider-track" id="gallerySliderTrack">
                <?php
                $top_photos = glob('assets/EventPhotos/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
                if ($top_photos) {
                    shuffle($top_photos); // Random order
                    foreach ($top_photos as $index => $photo) {
                        $src = str_replace('assets/', '', $photo);
                        $alt = !empty($graphics_seo[$photo]['alt']) ? htmlspecialchars($graphics_seo[$photo]['alt']) : 'Galeria Realizacji';
                        $title_attr = !empty($graphics_seo[$photo]['title']) ? 'title="' . htmlspecialchars($graphics_seo[$photo]['title']) . '"' : '';
                        
                        // Store full-res URL for lightbox and a smaller version for slider
                        echo '<div class="slider-item" data-src="image.php?src=' . urlencode($src) . '&w=1920&h=0" data-gallery="top-slider" ' . $title_attr . '>';
                        echo '<img src="image.php?src=' . urlencode($src) . '&w=800&h=0" alt="' . $alt . '" ' . $title_attr . ' loading="lazy" draggable="false" />';
                        echo '<div class="slider-overlay"><i class="fas fa-search-plus"></i></div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p style="text-align:center; width:100%; color: var(--text-muted);">Brak zdjęć w ogólnej galerii.</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Events Accordion -->
    <section class="events-gallery-section">
        <div class="events-gallery-container">
            <?php foreach ($gallery_events as $index => $event): ?>
                <div class="event-accordion">
                    <div class="accordion-header">
                        <div class="accordion-title-wrap">
                            <h2 class="event-title"><?php echo htmlspecialchars($event['title']); ?></h2>
                            <div class="event-tags">
                                <span class="event-tag date-tag"><?php echo htmlspecialchars($event['date']); ?></span>
                                <span
                                    class="event-tag location-tag"><?php echo htmlspecialchars($event['location']); ?></span>
                            </div>
                        </div>
                        <div class="accordion-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                    <div class="accordion-content">
                        <div class="gallery-masonry event-masonry">
                            <?php
                            $event_photos = glob($event['path'] . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
                            if ($event_photos) {
                                sort($event_photos); // Alphabetical sorting for predictable order within events
                                foreach ($event_photos as $photoIndex => $photo) {
                                    $src = str_replace('assets/', '', $photo);
                                    $event_id = $index;
                                    // Using data-src for full res image
                                    $alt = !empty($graphics_seo[$photo]['alt']) ? htmlspecialchars($graphics_seo[$photo]['alt']) : htmlspecialchars($event['title']);
                                    $title_attr = !empty($graphics_seo[$photo]['title']) ? 'title="' . htmlspecialchars($graphics_seo[$photo]['title']) . '"' : '';
                                    
                                    echo '<div class="gallery-item event-gallery-item" data-src="image.php?src=' . urlencode($src) . '&w=1920&h=0" data-gallery="event-' . $index . '" ' . $title_attr . '>';
                                    echo '<img src="image.php?src=' . urlencode($src) . '&w=600&h=0" alt="' . $alt . '" ' . $title_attr . ' loading="lazy" />';
                                    echo '<div class="gallery-overlay"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg></div>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<p style="text-align:center; width:100%; grid-column: 1 / -1; color: var(--text-muted); padding: 40px 0;">Brak zdjęć z tego wydarzenia.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</main>

<!-- Lightbox Modal -->
<div class="gallery-lightbox" id="galleryLightbox">
    <div class="lightbox-close" id="lightboxClose">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    </div>
    <div class="lightbox-nav lightbox-prev" id="lightboxPrev">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
    </div>
    <div class="lightbox-nav lightbox-next" id="lightboxNext">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
    </div>
    <div class="lightbox-content" id="lightboxContent">
        <img id="lightboxImage" src="" alt="Powiększone zdjęcie">
        <div class="lightbox-loader" id="lightboxLoader"></div>
    </div>
</div>

<?php require_once 'footer.php'; ?>