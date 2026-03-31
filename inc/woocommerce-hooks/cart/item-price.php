<?php
/**
 * Add product attributes and categories below the product name in the cart.
 * Each item separated by a middle dot ·
 */
add_filter( 'woocommerce_cart_item_name', 'custom_cart_item_meta_after_name', 10, 3 );

function custom_cart_item_meta_after_name( $product_name, $cart_item, $cart_item_key ) {
    $product = $cart_item['data'];

    if ( ! $product instanceof WC_Product ) {
        return $product_name;
    }

    $items = [];

    // 1. Categories
    $categories = wc_get_product_terms( $product->get_id(), 'product_cat', [ 'fields' => 'names' ] );

    if ( ! empty( $categories ) ) {
        $items[] = implode( ' | ', $categories );
    }

    // 2. Attributes
    foreach ( $product->get_attributes() as $attribute ) {

        if ( ! $attribute->get_visible() ) {
            continue;
        }

        if ( $attribute->is_taxonomy() ) {
            $values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), [ 'fields' => 'names' ] );
        } else {
            $values = $attribute->get_options();
        }

        if ( ! empty( $values ) ) {
            $items[] = implode( ' | ', $values );
        }
    }

    if ( empty( $items ) ) {
        return $product_name;
    }

    $meta_html = '<ul class="cart-item-meta">';
    foreach ( $items as $i => $item ) {
        $meta_html .= '<li class="cart-item-meta__item">';
        if ( $i > 0 ) {
            $meta_html .= '<span class="cart-item-meta__dot" aria-hidden="true">&middot;</span>';
        }
        $meta_html .= esc_html( $item );
        $meta_html .= '</li>';
    }
    $meta_html .= '</ul>';

    return $product_name . $meta_html;
}