<?php

/*
 * Set custom icon for "Remove Cart Item" button
 */
add_filter( 'woocommerce_cart_item_remove_link', 'my_custom_cart_remove_icon', 10, 2 );

function my_custom_cart_remove_icon( $link, $cart_item_key ) {
    $product_id   = WC()->cart->get_cart()[ $cart_item_key ]['product_id'];
    $product      = wc_get_product( $product_id );
    $product_name = $product ? $product->get_name() : '';

    // Set custom icon here:
    $icon = get_inline_svg('trash-icon');

    $custom_link = sprintf(
        '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">%s</a>',
        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
        esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), $product_name ) ),
        esc_attr( $product_id ),
        esc_attr( $product ? $product->get_sku() : '' ),
        $icon
    );

    return $custom_link;
}
