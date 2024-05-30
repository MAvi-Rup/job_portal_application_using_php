// Event listeners and interactivity
window.addEventListener('DOMContentLoaded', function() {
    // Toggle navigation menu on smaller screens
    const menuToggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('nav');
  
    if (menuToggle && nav) {
      menuToggle.addEventListener('click', function() {
        nav.classList.toggle('active');
      });
    }
  
    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
      form.addEventListener('submit', function(event) {
        if (!validateForm(form)) {
          event.preventDefault();
        }
      });
    });
  });