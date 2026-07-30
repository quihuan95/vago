/**
 * VAGO front-end interactions: mobile navigation drawer, home banner slider,
 * and the photo album lightbox. Kept dependency-free (vanilla JS) on purpose.
 */

function initMobileNav() {
    const toggle = document.getElementById('nav-toggle');
    const drawer = document.getElementById('mobile-nav');

    if (!toggle || !drawer) {
        return;
    }

    toggle.addEventListener('click', () => {
        const isHidden = drawer.classList.toggle('hidden');
        toggle.setAttribute('aria-expanded', String(!isHidden));
    });

    // Close the drawer automatically when the viewport grows back to desktop.
    window.matchMedia('(min-width: 1024px)').addEventListener('change', (event) => {
        if (event.matches) {
            drawer.classList.add('hidden');
            toggle.setAttribute('aria-expanded', 'false');
        }
    });
}

function initSliders() {
    document.querySelectorAll('[data-slider]').forEach((slider) => {
        const slides = Array.from(slider.querySelectorAll('[data-slide-index]'));

        if (slides.length <= 1) {
            return;
        }

        const dots = Array.from(slider.querySelectorAll('[data-slider-dot]'));
        const prevBtn = slider.querySelector('[data-slider-prev]');
        const nextBtn = slider.querySelector('[data-slider-next]');
        const interval = parseInt(slider.dataset.sliderInterval || '6000', 10);

        let current = 0;
        let timer = null;

        const show = (index) => {
            current = (index + slides.length) % slides.length;

            slides.forEach((slide, i) => {
                const isActive = i === current;
                slide.classList.toggle('opacity-100', isActive);
                slide.classList.toggle('opacity-0', !isActive);
                slide.classList.toggle('pointer-events-none', !isActive);
            });

            dots.forEach((dot, i) => {
                dot.classList.toggle('bg-white', i === current);
                dot.classList.toggle('bg-white/40', i !== current);
            });
        };

        const stop = () => {
            if (timer) {
                clearInterval(timer);
                timer = null;
            }
        };

        const start = () => {
            stop();
            timer = setInterval(() => show(current + 1), interval);
        };

        prevBtn?.addEventListener('click', () => {
            show(current - 1);
            start();
        });

        nextBtn?.addEventListener('click', () => {
            show(current + 1);
            start();
        });

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                show(i);
                start();
            });
        });

        slider.addEventListener('mouseenter', stop);
        slider.addEventListener('mouseleave', start);

        show(0);
        start();
    });
}

function initLightbox() {
    const galleries = document.querySelectorAll('[data-lightbox-gallery]');
    const lightbox = document.getElementById('lightbox');

    if (!galleries.length || !lightbox) {
        return;
    }

    const image = document.getElementById('lightbox-image');
    const caption = document.getElementById('lightbox-caption');
    const closeBtn = lightbox.querySelector('[data-lightbox-close]');
    const prevBtn = lightbox.querySelector('[data-lightbox-prev]');
    const nextBtn = lightbox.querySelector('[data-lightbox-next]');

    galleries.forEach((gallery) => {
        const triggers = Array.from(gallery.querySelectorAll('[data-lightbox-trigger]'));
        let current = 0;

        const open = (index) => {
            current = (index + triggers.length) % triggers.length;
            const trigger = triggers[current];

            image.src = trigger.dataset.lightboxSrc;
            image.alt = trigger.dataset.lightboxCaption || '';
            caption.textContent = trigger.dataset.lightboxCaption || '';

            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        };

        const close = () => {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        };

        triggers.forEach((trigger, index) => {
            trigger.addEventListener('click', () => open(index));
        });

        closeBtn?.addEventListener('click', close);
        prevBtn?.addEventListener('click', () => open(current - 1));
        nextBtn?.addEventListener('click', () => open(current + 1));

        lightbox.addEventListener('click', (event) => {
            if (event.target === lightbox) {
                close();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (lightbox.classList.contains('hidden')) {
                return;
            }

            if (event.key === 'Escape') close();
            if (event.key === 'ArrowLeft') open(current - 1);
            if (event.key === 'ArrowRight') open(current + 1);
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initMobileNav();
    initSliders();
    initLightbox();
});
