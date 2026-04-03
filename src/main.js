import InitPopups from './js/popup.js';
import MobileMenu from './js/mobile-menu.js';
import TestimSlider from './js/testimonials.js';
import HeaderCart from './js/header-cart.js';

import './js/header-submenu';
import './js/reset-pass';
import './js/product-tab';
import './js/accordion';
import './js/header-scroll';
import './scss/main.scss';

/*
 * On DOM Content Load
 */
document.addEventListener('DOMContentLoaded', () => {

  InitPopups();
  MobileMenu();
  TestimSlider();
  HeaderCart();

});

/*
 * On Full Page Load
 */
window.addEventListener('load', () => {

});
