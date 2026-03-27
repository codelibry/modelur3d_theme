<?php

/*
 * Register Menus
 */
function codelibry_register_menus(){
  register_nav_menus(
    array(
      'header-menu' => __('Header Menu', 'codelibry'),
      'mobile-menu' => __('Mobile Menu', 'codelibry'),
      'footer-menu-1' => __('Footer Col 1', 'codelibry'),
      'footer-menu-2' => __('Footer Col 2', 'codelibry'),
      'footer-menu-3' => __('Footer Col 3', 'codelibry'),
    )
  );
}

add_action( 'after_setup_theme', 'codelibry_register_menus' );
