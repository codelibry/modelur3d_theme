<?php

/*
 * Add Wishlist tab to my-account
 * Note: add_action must follow 'woocommerce_account_{your-endpoint-slug}_endpoint' format
 */

add_action('init', function() {
  add_rewrite_endpoint('my-wishlist', EP_ROOT | EP_PAGES );
});

add_filter('query_vars', function($vars) {
  $vars[] = 'my-wishlist';
  return $vars;
}, 0);
  
// add "my-wishlist" link in account navigation
add_filter('woocommerce_account_menu_items', function($items) {
  $items['my-wishlist'] = __('Wishlist', 'codelibry');
  return $items;
});
  
// add HTML content in my-wishlist tab
add_action('woocommerce_account_my-wishlist_endpoint', function() { ?>
  <div class="woocommerce-wishlist">
    <?php echo do_shortcode('[yith_wcwl_wishlist]'); ?>
  </div>
<?php });

add_action('template_redirect', function() {
    if (is_page('wishlist') && is_user_logged_in()) {
        wp_redirect(wc_get_account_endpoint_url('my-wishlist'));
        exit;
    }
});
