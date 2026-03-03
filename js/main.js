document.addEventListener('DOMContentLoaded', () => {

    // --- Header Scroll Effect ---
    const header = document.querySelector('.main-header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // --- Mobile Menu Toggle ---
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const navLinks = document.querySelector('.nav-links');

    if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            menuToggle.classList.toggle('active');
        });
    }

    // --- Number Counter Animation ---
    const statNumbers = document.querySelectorAll('.stat-number');
    let hasCounted = false;

    const animateCounters = () => {
        statNumbers.forEach(number => {
            const target = +number.getAttribute('data-target');
            const duration = 2000; // ms
            const stepTime = Math.abs(Math.floor(duration / target));

            let current = 0;
            const increment = target > 1000 ? Math.ceil(target / 100) : 1;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    number.innerText = target;
                    clearInterval(timer);
                } else {
                    number.innerText = current;
                }
            }, stepTime > 0 ? stepTime : 20);
        });
    };

    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting && !hasCounted) {
                animateCounters();
                hasCounted = true;
            }
        }, { threshold: 0.5 });
        observer.observe(statsSection);
    }


    // --- 3D Horizontal Carousel ---
    const track = document.getElementById('carouselTrack');
    if (track) {
        const items = Array.from(track.children);
        const itemWidth = 450 + 30; // .carousel-item width + gap
        let offset = 0;
        let isAnimating3D = false;
        let speed = 1.5; // px per frame
        let animationFrameId;
        let previousTimestamp = null;

        let lastPopTimestamp = 0;
        const popDuration = 2500; // Total time photo is popped out
        const minIdleTime = 250; // Time between pops (ćwierć sekundy)
        let currentPoppedItem = null;

        // Clone items endlessly when reached end
        const cloneIfNeeded = () => {
            const trackRect = track.getBoundingClientRect();
            // If the rightmost edge is getting close to the viewport edge
            if (trackRect.right < window.innerWidth + 1000) {
                items.forEach(item => {
                    const clone = item.cloneNode(true);
                    track.appendChild(clone);
                });
            }
        };

        const animateTrack = (timestamp) => {
            if (!previousTimestamp) previousTimestamp = timestamp;
            const deltaTime = timestamp - previousTimestamp;
            previousTimestamp = timestamp;

            // Only move if not in 3D pop state
            if (!isAnimating3D) {
                offset -= speed * (deltaTime / 16); // Normalize to ~60fps
                track.style.transform = `translateX(${offset}px)`;
                cloneIfNeeded();
            }

            // Logic to pop out a random item
            if (!isAnimating3D && (timestamp - lastPopTimestamp) > (popDuration + minIdleTime)) {
                // Find all items currently visible in viewport roughly
                const visibleItems = Array.from(track.children).filter(item => {
                    const rect = item.getBoundingClientRect();
                    return rect.left > 100 && rect.right < (window.innerWidth - 100);
                });

                if (visibleItems.length > 0) {
                    // Pick a random visible item to pop out
                    currentPoppedItem = visibleItems[Math.floor(Math.random() * visibleItems.length)];
                    currentPoppedItem.classList.add('active-3d');
                    isAnimating3D = true;
                    lastPopTimestamp = timestamp;

                    // Revert after duration
                    setTimeout(() => {
                        if (currentPoppedItem) {
                            currentPoppedItem.classList.remove('active-3d');
                            currentPoppedItem = null;
                        }
                        // Resume scrolling after CSS transition finishes (~800ms)
                        setTimeout(() => {
                            isAnimating3D = false;
                            lastPopTimestamp = performance.now();
                        }, 800);
                    }, popDuration);
                }
            }

            animationFrameId = requestAnimationFrame(animateTrack);
        };

        animationFrameId = requestAnimationFrame(animateTrack);

        // Pause on hover
        track.addEventListener('mouseenter', () => speed = 0.5);
        track.addEventListener('mouseleave', () => speed = 1.5);
    }

    // --- Simple Particle System ---
    // Removed Simple Particle System since we use p5.js now

    // --- Hero Text Animation ---
    const animatedWordElement = document.getElementById('animated-word');
    if (animatedWordElement) {
        const words = [
            "IMMERSYJNE",
            "EMOCJONUJĄCE",
            "DZIKIE",
            "WCIĄGAJĄCE",
            "ANGAŻUJĄCE",
            "WIDOWISKOWE"
        ];
        let wordIndex = 0;

        setInterval(() => {
            // Fade out
            animatedWordElement.classList.remove('word-visible');
            animatedWordElement.classList.add('word-hidden');

            setTimeout(() => {
                // Change word and Fade in
                wordIndex = (wordIndex + 1) % words.length;
                animatedWordElement.innerText = words[wordIndex];
                animatedWordElement.classList.remove('word-hidden');
                animatedWordElement.classList.add('word-visible');
            }, 500); // Should match CSS transition duration
        }, 2500); // Change word every 2.5s
    }
});

// --- P5.JS Flow Field Background ---
const deg = (a) => Math.PI / 180 * a;
const randRange = (v1, v2) => Math.floor(v1 + Math.random() * (v2 - v1));
const opt = {
    particles: window.innerWidth / 500 ? 1500 : 800,
    noiseScale: 0.009,
    angle: Math.PI / 180 * -90,
    h1: randRange(260, 290), // Purple range
    h2: randRange(250, 280), // Purple range
    s1: randRange(60, 100), // Higher saturation
    s2: randRange(60, 100), // Higher saturation
    l1: randRange(50, 80),  // Lighter for contrast
    l2: randRange(50, 80),  // Lighter for contrast
    strokeWeight: 1.8,      // Thicker lines
    tail: 82,
};

const Particles = [];
let time = 0;

// --- Hero Image Slider ---
document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.hero-slide');
    if (slides.length > 0) {
        let currentSlide = 0;

        // Ensure first slide is active immediately
        slides[currentSlide].classList.add('active');

        setInterval(() => {
            // Fade out current slide
            slides[currentSlide].classList.remove('active');

            // Advance to next slide
            currentSlide = (currentSlide + 1) % slides.length;

            // Force reflow to correctly restart animations
            const nextSlide = slides[currentSlide];
            nextSlide.classList.remove('active');
            void nextSlide.offsetWidth;

            // Activate next slide
            nextSlide.classList.add('active');
        }, 12000); // 12 seconds per slide
    }

    // --- Mobile Screen Slideshow ---
    const mobileScreensSets = document.querySelectorAll('.mobile-screen.fade-slideshow');
    mobileScreensSets.forEach(screenSet => {
        const images = screenSet.querySelectorAll('img');
        if (images.length > 1) {
            let currentIndex = 0;
            setInterval(() => {
                images[currentIndex].classList.remove('active');
                currentIndex = (currentIndex + 1) % images.length;
                images[currentIndex].classList.add('active');
            }, 3000); // 3 seconds per screen
        }
    });

    // =========================================================================
    // GALLERY PAGE SCRIPTS
    // =========================================================================

    // Top Dynamic Slider
    const galleryContainer = document.getElementById('gallerySliderContainer');
    const galleryTrack = document.getElementById('gallerySliderTrack');

    if (galleryContainer && galleryTrack) {
        const updateScale = () => {
            const containerCenter = galleryContainer.getBoundingClientRect().left + galleryContainer.offsetWidth / 2;
            const currentItems = galleryTrack.querySelectorAll('.slider-item');

            currentItems.forEach(item => {
                const itemCenter = item.getBoundingClientRect().left + item.offsetWidth / 2;
                const distance = Math.abs(containerCenter - itemCenter);
                const maxDistance = galleryContainer.offsetWidth / 2;

                // Scale map: center is 1.15, edges going down to 0.8
                let scale = 1.15 - (distance / maxDistance) * 0.35;
                if (scale < 0.8) scale = 0.8;

                // Opacity map: center is 1, edges go down to 0.5
                let opacity = 1 - (distance / maxDistance) * 0.5;
                if (opacity < 0.3) opacity = 0.3;

                item.style.transform = `scale(${scale})`;
                item.style.opacity = opacity;
            });
        };

        // Scroll event to update scale
        galleryContainer.addEventListener('scroll', () => {
            requestAnimationFrame(updateScale);
        }, { passive: true });

        // Initial call after small delay for layout to settle
        setTimeout(() => {
            // Scroll to center initially
            galleryContainer.scrollLeft = (galleryTrack.scrollWidth - galleryContainer.clientWidth) / 2;
            updateScale();
        }, 100);

        // Drag to scroll functionality & Auto Scroll
        let isDown = false;
        let startX;
        let scrollLeft;
        let isAutoScrolling = true;
        let autoScrollSpeed = 1; // px per frame

        const animateSlider = () => {
            if (isAutoScrolling && !isDown) {
                galleryContainer.scrollLeft += autoScrollSpeed;

                // Infinite scroll: append clones when getting close to the end
                if (galleryTrack.scrollWidth - galleryContainer.scrollLeft < galleryContainer.clientWidth + 500) {
                    const children = Array.from(galleryTrack.children);
                    for (let i = 0; i < 3; i++) {
                        if (children[i]) {
                            const clone = children[i].cloneNode(true);
                            galleryTrack.appendChild(clone);
                        }
                    }
                }
            }
            requestAnimationFrame(animateSlider);
        };
        requestAnimationFrame(animateSlider);

        galleryContainer.addEventListener('mousedown', (e) => {
            isDown = true;
            galleryContainer.style.cursor = 'grabbing';
            startX = e.pageX - galleryContainer.offsetLeft;
            scrollLeft = galleryContainer.scrollLeft;
        });
        galleryContainer.addEventListener('mouseleave', () => {
            isDown = false;
            isAutoScrolling = true;
            galleryContainer.style.cursor = 'grab';
        });
        galleryContainer.addEventListener('mouseenter', () => {
            isAutoScrolling = false;
        });
        galleryContainer.addEventListener('mouseup', () => {
            isDown = false;
            galleryContainer.style.cursor = 'grab';
        });
        galleryContainer.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - galleryContainer.offsetLeft;
            const walk = (x - startX) * 2; // scroll speed multiplier
            galleryContainer.scrollLeft = scrollLeft - walk;
        });

        galleryContainer.addEventListener('touchstart', () => isAutoScrolling = false, { passive: true });
        galleryContainer.addEventListener('touchend', () => {
            setTimeout(() => { if (!isDown) isAutoScrolling = true; }, 1000);
        }, { passive: true });
    }

    // Events Accordion
    const accordions = document.querySelectorAll('.event-accordion');
    accordions.forEach(acc => {
        const header = acc.querySelector('.accordion-header');
        const content = acc.querySelector('.accordion-content');

        const recalcHeight = () => {
            if (acc.classList.contains('active')) {
                content.style.maxHeight = content.scrollHeight + 'px';
            }
        };

        content.querySelectorAll('img').forEach(img => {
            img.addEventListener('load', recalcHeight);
        });

        header.addEventListener('click', () => {
            const isActive = acc.classList.contains('active');

            accordions.forEach(a => {
                a.classList.remove('active');
                a.querySelector('.accordion-content').style.maxHeight = null;
            });

            if (!isActive) {
                acc.classList.add('active');
                content.style.maxHeight = content.scrollHeight + 'px';
            }
        });
    });

    // Lightbox Logic
    const lightbox = document.getElementById('galleryLightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxClose = document.getElementById('lightboxClose');
    const lightboxPrev = document.getElementById('lightboxPrev');
    const lightboxNext = document.getElementById('lightboxNext');
    const lightboxLoader = document.getElementById('lightboxLoader');

    if (lightbox) {
        let currentGallery = [];
        let currentIndex = 0;

        const openLightbox = (src, galleryName) => {
            // Find all images in the same gallery
            const galleryElements = document.querySelectorAll(`[data-gallery="${galleryName}"]`);
            currentGallery = Array.from(galleryElements).map(el => el.getAttribute('data-src'));
            currentIndex = currentGallery.indexOf(src);
            if (currentIndex === -1) currentIndex = 0; // fallback

            updateLightboxImage();
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden'; // block bg scroll
        };

        const closeLightbox = () => {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
            setTimeout(() => { lightboxImage.src = ''; }, 300);
        };

        const updateLightboxImage = () => {
            lightboxLoader.style.display = 'block';
            lightboxImage.style.opacity = '0';

            const newImage = new Image();
            newImage.onload = () => {
                lightboxImage.src = currentGallery[currentIndex];
                lightboxImage.style.opacity = '1';
                lightboxLoader.style.display = 'none';
            };
            newImage.src = currentGallery[currentIndex];
        };

        const nextImage = () => {
            currentIndex = (currentIndex + 1) % currentGallery.length;
            updateLightboxImage();
        };

        const prevImage = () => {
            currentIndex = (currentIndex - 1 + currentGallery.length) % currentGallery.length;
            updateLightboxImage();
        };

        // Attach clicks using event delegation to support dynamically added clones
        document.body.addEventListener('click', (e) => {
            const item = e.target.closest('[data-gallery]');
            if (item) {
                // Ignore if we are just dragging the slider
                if (item.closest('.gallery-slider-container') && e.detail === 0) return;
                const src = item.getAttribute('data-src');
                const galleryName = item.getAttribute('data-gallery');
                openLightbox(src, galleryName);
            }
        });

        lightboxClose.addEventListener('click', closeLightbox);
        lightboxNext.addEventListener('click', nextImage);
        lightboxPrev.addEventListener('click', prevImage);

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (!lightbox.classList.contains('active')) return;
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') nextImage();
            if (e.key === 'ArrowLeft') prevImage();
        });

        // Swipe support wrapper
        let touchstartX = 0;
        let touchendX = 0;

        const handleGesture = () => {
            if (touchendX < touchstartX - 50) nextImage();
            if (touchendX > touchstartX + 50) prevImage();
        }

        lightbox.addEventListener('touchstart', e => {
            touchstartX = e.changedTouches[0].screenX;
        }, { passive: true });

        lightbox.addEventListener('touchend', e => {
            touchendX = e.changedTouches[0].screenX;
            handleGesture();
        }, { passive: true });

        // Close on background click
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox || e.target === document.getElementById('lightboxContent')) {
                closeLightbox();
            }
        });
    }

});
