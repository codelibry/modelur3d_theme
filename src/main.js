import InitPopups from './js/popup.js';
import MobileMenu from './js/mobile-menu.js';
import TestimSlider from './js/testimonials.js';

import './js/header-submenu';
import './js/reset-pass';
import './js/password-toggle';
import './js/product-tab';
import './scss/main.scss';

/*
 * On DOM Content Load
 */
document.addEventListener('DOMContentLoaded', () => {

  InitPopups();
  MobileMenu();
  TestimSlider();

});

/*
 * On Full Page Load
 */
window.addEventListener('load', () => {

});
