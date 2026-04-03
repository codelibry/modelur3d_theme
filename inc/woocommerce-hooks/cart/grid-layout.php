<?php

/*
 * Wrap Cart in GRID Layout
 */
add_action( 'woocommerce_before_cart_table', function() { ?>
    <div class="cart-grid">
        <div class="cart-table-column | box">
<?php } );

add_action( 'woocommerce_after_cart_table', function() { ?>
    </div>
<?php } );

add_action( 'woocommerce_after_cart', function() { ?>
    </div>
</div>
</div>
    <?php 
    
    
    get_template_part( 'template-parts/blocks/product-related', null, [
        'title' => 'Our collection',
    ] ); ?>


<?php } );


add_action( 'init', function() {
    remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
} );

// Re-render the checkout button + continue shopping OUTSIDE the box
add_action( 'woocommerce_after_cart_totals', function() { ?>
    <div class="wc-proceed-to-checkout">
        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="button">
            <?php esc_html_e( 'Continue Shopping', 'codelibry' ); ?>
        </a>
        <?php woocommerce_button_proceed_to_checkout(); ?>
    </div>
<?php }, 20 );
