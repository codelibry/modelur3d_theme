<?php

/*
 * Add Sidebar with Filters + Start "shop" container
 */
add_action( 'woocommerce_shop_loop_header', function() { ?>
	<div class="container">
		<div class="shop-grid">
			<aside class="shop-filters-column">
        <div class="shop-filters">
			
			<?php echo do_shortcode('[woof_mobile]'); ?>
            <?php echo do_shortcode('[woof mobile_mode=1 sid="test"]'); ?>
        </div>
			</aside>
<?php }, 10);


/*
 * Wrap Products Grid + End "shop" container
 */
add_action( 'woocommerce_before_shop_loop', function() { ?>
	<div class="shop-products">
<?php }, 0);

add_action( 'woocommerce_after_shop_loop', function() { ?>
	</div>
<?php }, 20);

/*
 *  Add container for filter results on shop page
 */
add_action( 'woocommerce_before_shop_loop', function() { ?>
	<div class="woof_products_top_panel"></div>
<?php }, 15);

/*
 * Wrap "Results Count" and "OrderBy" components in a single container
 */
add_action( 'woocommerce_before_shop_loop', function() { ?>
	<div class="shop-top-bar | repel">
<?php }, 15);

add_action( 'woocommerce_before_shop_loop', function() { ?>
	</div>
<?php }, 35);

/*
 *  Add container for filter results on shop page when no products
 */
remove_action( 'woocommerce_no_products_found', 'wc_no_products_found' );

add_action( 'woocommerce_no_products_found', function() { ?>
	<div class="shop-products">
		<div class="woof_products_top_panel"></div>
		<div class="shop-top-bar | repel"></div>
		<div class="woocommerce-info">No products were found matching your selection.</div>
	</div>
<?php }, 15);

