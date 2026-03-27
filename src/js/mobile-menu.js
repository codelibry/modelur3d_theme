/*
 * Mobile Menu
 */
function mobileMenu() {
  if(!document.querySelector('.mobile-menu')) {
    return;
  }

  const button = document.querySelector('.header__mobile-menu-button');
  const menu = document.querySelector('.mobile-menu');

  // on button click
  button.addEventListener('click', () => {
    menu.classList.toggle('open');
  });
  
  // on click outside
  document.addEventListener('click', (e) => {
    if (e.target.closest('.header__mobile-menu-button') || e.target.closest('.menu-item-has-children')) {
      return;
    }

    // Otherwise, close
    menu.classList.remove('open');
  });
}

export default mobileMenu;
