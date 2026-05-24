// Scroll to top on page load
window.addEventListener('load', function() {
    window.scrollTo(0, 0);
});


// Add scroll event listener for header effects
window.addEventListener('scroll', function() {
    const header = document.querySelector('header');
    if (window.scrollY > 100) {
        header.classList.add('border-b');
    } else {
        header.classList.remove('border-b');
    }
});
