<?php

/*
 * Wrap "Product Gallery" and "Product Summary" into container
 */
add_action( 'woocommerce_before_single_product_summary', function() { ?>
	<section class="single-product-wrapper">
		<div class="container">
			<div class="single-product-grid | grid">
<?php }, 0 );

add_action( 'woocommerce_after_single_product_summary', function() { ?>
			</div>
		</div>
	</section>
<?php }, 0 );


/**
 * Open wrapper div around price + add to cart.
 */
function custom_price_cart_wrapper_open() {
    echo '<div class="custom-price-cart-wrapper">';
}

/**
 * Close wrapper div around price + add to cart.
 */
function custom_price_cart_wrapper_close() {
    echo '</div>';
}