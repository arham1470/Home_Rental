document.addEventListener('DOMContentLoaded', function () {
    const currentYearElements = document.querySelectorAll('[data-current-year]');
    currentYearElements.forEach(function (el) {
        el.textContent = new Date().getFullYear();
    });

    const navbar = document.getElementById('mainNav');
    const handleScroll = function () {
        if (!navbar) return;
        if (window.scrollY > 24) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    };

    handleScroll();
    window.addEventListener('scroll', handleScroll);

    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 650,
            easing: 'ease-out-cubic',
            once: true,
            offset: 30
        });
    }

    const animatedCounters = document.querySelectorAll('[data-counter]');
    animatedCounters.forEach(function (counter) {
        const target = parseInt(counter.getAttribute('data-counter'), 10) || 0;
        let current = 0;
        const step = Math.max(1, Math.ceil(target / 60));

        const run = function () {
            current += step;
            if (current >= target) {
                counter.textContent = target.toLocaleString();
                return;
            }
            counter.textContent = current.toLocaleString();
            requestAnimationFrame(run);
        };

        const observer = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    run();
                    obs.unobserve(counter);
                }
            });
        }, { threshold: 0.35 });

        observer.observe(counter);
    });
});
