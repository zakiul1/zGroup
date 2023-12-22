document.addEventListener('DOMContentLoaded', function () {
    // Toggle dropdowns
    var dropdowns = document.querySelectorAll('[data-dropdown-toggle]');
    dropdowns.forEach(function (dropdown) {
        dropdown.addEventListener('click', function (event) {
            var target = document.getElementById(this.getAttribute('data-dropdown-toggle'));
            if (target) {
                target.classList.toggle('hidden');
            }
            event.preventDefault();
        });
    });
});
