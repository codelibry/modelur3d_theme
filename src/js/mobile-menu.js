/*
 * Mobile Menu
 */
function mobileMenu() {
  if(!document.querySelector('.mobile-menu')) {
    return;
  }

  const button = document.querySelector('.header__mobile-menu-button');
  const menu = document.querySelector('.mobile-menu');
  const main = document.querySelector('main');

  const open = () => {
    menu.classList.add('open');
    main?.classList.add('menu-blur');
  };

  const close = () => {
    menu.classList.remove('open');
    main?.classList.remove('menu-blur');
  };

  // on button click
  button.addEventListener('click', () => {
    menu.classList.contains('open') ? close() : open();
  });

  // on click outside
  document.addEventListener('click', (e) => {
    if (e.target.closest('.header__mobile-menu-button') || e.target.closest('.menu-item-has-children')) {
      return;
    }

    close();
  });
}

export default mobileMenu;