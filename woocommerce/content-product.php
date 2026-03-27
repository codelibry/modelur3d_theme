<?php

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}

$image_id  = $product->get_image_id() ? $product->get_image_id() : get_option( 'woocommerce_placeholder_image' );
$title     = $product->get_name();
$price     = $product->get_price();
$permalink = get_permalink( $product->get_id() );

?>

<li <?php wc_product_class( 'product-card | swiper-slide', $product ); ?>>
    <div class="product-card__wishlist">
        <?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
    </div>

    <a class="product-card__image-box" href="<?php echo esc_url( $permalink ); ?>">
        <?php echo wp_get_attachment_image( $image_id, 'medium', false, [ 'loading' => 'lazy' ] ); ?>
    </a>

    <?php if ( $title ) : ?>
        <h3 class="product-card__title | h6"><?php echo esc_html( $title ); ?></h3>
    <?php endif; ?>

    <?php if ( $price ) : ?>
        <p class="product-card__price"><?php echo wc_price( $price ); ?></p>
    <?php endif; ?>

    <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
</li>
