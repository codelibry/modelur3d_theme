<?php
/*
 * Constants
 */

if ( ! defined( 'CODELIBRY_THEME_VERSION' ) ) {
	define( 'CODELIBRY_THEME_VERSION', '1.0.0' );
}

if ( ! defined( 'CODELIBRY_THEME_PATH' ) ) {
	define( 'CODELIBRY_THEME_PATH', get_stylesheet_directory() );
}

if ( ! defined( 'CODELIBRY_THEME_URI' ) ) {
	define( 'CODELIBRY_THEME_URI', get_stylesheet_directory_uri() );
}

require CODELIBRY_THEME_PATH . '/inc/acf.php';
require CODELIBRY_THEME_PATH . '/inc/helpers.php';
require CODELIBRY_THEME_PATH . '/inc/shortcodes.php';
require CODELIBRY_THEME_PATH . '/inc/ajax.php';
require CODELIBRY_THEME_PATH . '/inc/post-types.php';
require CODELIBRY_THEME_PATH . '/inc/taxonomies.php';
require CODELIBRY_THEME_PATH . '/inc/theme-hooks.php';
require CODELIBRY_THEME_PATH . '/inc/woocommerce-hooks.php';
