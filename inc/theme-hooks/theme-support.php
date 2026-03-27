<?php 

/*
 * Add Theme Support
 */
function codelibry_supports(){

  // WordPress Support
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );

  // Woocommerce Support
  add_theme_support( 'woocommerce' );
  add_theme_support( 'wc-product-gallery-zoom' );
  add_theme_support( 'wc-product-gallery-lightbox' );
  add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'codelibry_supports' );

add_filter( 'acf/settings/show_admin', '__return_false' );

add_action( 'admin_init', function () {
    $post_id = $_GET['post'] ?? $_POST['post_ID'] ?? null;

    if ( ! $post_id ) {
        remove_post_type_support( 'page', 'editor' );
        return;
    }

    $template = get_post_meta( $post_id, '_wp_page_template', true );

    if ( $template !== 'page-templates/content-page.php' ) {
        remove_post_type_support( 'page', 'editor' );
    }
} );
