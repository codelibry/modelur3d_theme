<?php

$product = $args['product'];

if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}

$image_id = $product->get_image_id() ? $product->get_image_id() : get_option( 'woocommerce_placeholder_image' );
$title = $product->get_name();
$price = $product->get_price();
$permalink = get_permalink( $product->get_id() );

?>

<li class="product-search-item">
    <a class="product-search-item__inner" href="<?php echo esc_url( $permalink ); ?>">
        <div class="product-search-item__image-box">
            <?php echo wp_get_attachment_image( $image_id, 'thumbnail', false, [ 'loading' => 'lazy' ] ) ?>
        </div>

        <?php if ( $title ) : ?>
            <h3 class="product-search-item__title"><?php echo esc_html( $title ) ?></h3>
        <?php endif; ?>

        <?php if ( $price ) : ?>
            <p class="product-search-item__price"><?php echo wc_price( $price ); ?></p>
        <?php endif; ?>
    </a>
</li>
