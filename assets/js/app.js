document.addEventListener('DOMContentLoaded', function () {
    const currentYearElements = document.querySelectorAll('[data-current-year]');
    currentYearElements.forEach(function (el) {
        el.textContent = new Date().getFullYear();
    });
});
