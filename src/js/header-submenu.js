(function() {
  function headerSubmenu() {
    if(!document.querySelector('.menu-item-has-children')) {
      return;
    }

    document.querySelectorAll('.menu-item-has-children').forEach(item => {
      
      const link = item.querySelector('a');
      const submenu = item.querySelector('.sub-menu');

      link.addEventListener('click', (e) => {
        e.preventDefault();

        // Close all other submenus
        document.querySelectorAll('.sub-menu.open').forEach(openSub => {
          if (openSub !== submenu) {
            openSub.classList.remove('open');
          }
        });

        // Toggle this submenu
        submenu.classList.toggle('open');
        item.classList.toggle('menu-open')
      });
    });

    // Click outside to close
    document.addEventListener('click', (e) => {
      if (e.target.closest('.menu-item-has-children')) {
        return;
      }
      document.querySelectorAll('.sub-menu.open').forEach(submenu => {
        submenu.classList.remove('open');
        document.querySelector('.menu-open').classList.remove('menu-open')
      });
    });
  }
  let lastScroll = 0;
    window.addEventListener('scroll', () => {
      const currentScroll = window.scrollY;
      if (Math.abs(currentScroll - lastScroll) > 10) {
        document.querySelectorAll('.sub-menu.open').forEach(submenu => {
          submenu.classList.remove('open');
          submenu.closest('.menu-item-has-children').classList.remove('menu-open');
        });
      }
      lastScroll = currentScroll;
    });
  // Run on DOM ready
  document.addEventListener('DOMContentLoaded', headerSubmenu);
})();
