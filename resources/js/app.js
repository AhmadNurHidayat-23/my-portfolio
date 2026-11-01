/**
 * Ahmad Nur Hidayat — Personal Portfolio
 * Main Application JavaScript
 */

/**
 * Initializes smooth back-to-top functionality for the footer button
 * and home anchor links. Resolves the browser calculation issue where
 * sticky-positioned elements are perceived as already in-viewport.
 */
function initBackToTop() {
    const topTriggers = document.querySelectorAll('.contact-back-to-top, .contact-nav-list a[href="#hero"]');

    topTriggers.forEach((trigger) => {
        trigger.addEventListener('click', (event) => {
            event.preventDefault();

            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            window.scrollTo({
                top: 0,
                left: 0,
                behavior: prefersReducedMotion ? 'instant' : 'smooth',
            });

            // Update URL without triggering default anchor jump
            if (window.history && window.history.replaceState) {
                window.history.replaceState(null, '', window.location.pathname + window.location.search);
            }
        });
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initBackToTop);
} else {
    initBackToTop();
}
