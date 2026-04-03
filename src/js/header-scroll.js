const header = document.querySelector('.header');

if (header) {
  window.addEventListener('scroll', () => {
    header.classList.toggle('header-scroll', window.scrollY > 600);
  }, {passive: true});
}
