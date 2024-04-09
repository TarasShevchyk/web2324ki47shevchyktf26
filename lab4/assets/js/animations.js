// animations.js
window.addEventListener('load', function() {
  const animatedElements = document.querySelectorAll('.animate__animated');

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate__animated', entry.target.dataset.animation);
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.5
  });

  animatedElements.forEach(element => {
    observer.observe(element);
  });
});