<?php

/*
 * Display Custom "Shop Banner" section
 */
add_action( 'woocommerce_shop_loop_header', function() {

  get_template_part('template-parts/blocks/shop-banner', null, [
    'image' => get('shop-banner__image', $options = true),
    'title' => get('shop-banner__title', $options = true),
    'description' => get('shop-banner__description', $options = true),
  ]);

}, 10 );
