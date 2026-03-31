<?php
/**
 * Wrapp description
 */
function custom_single_product_full_description() {
    global $product;

    $description = $product->get_description();

    if ( ! $description ) {
        return;
    }

    echo '<div class="custom-product-description">';
    echo apply_filters( 'the_content', $description );
    echo '</div>';
}

