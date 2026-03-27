<?php

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}

$image_id   = $product->get_image_id() ? $product->get_image_id() : get_option( 'woocommerce_placeholder_image' );
$title      = $product->get_name();
$price      = $product->get_price();
$permalink  = get_permalink( $product->get_id() );
$attributes = $product->get_attributes();

?>

<li <?php wc_product_class( 'product-card', $product ); ?>>


    <div class="product-card__thumbnail">
        <?php echo wp_get_attachment_image( $image_id, 'medium', false, [ 'loading' => 'lazy' ] ); ?>

        <a class="product-card__icon-link" href="<?php echo esc_url( $permalink ); ?>" aria-label="<?php echo esc_attr( $title ); ?>">
            <?php echo get_inline_svg('go-to'); ?>
        </a>
    </div>
    <?php
    $attr_items = [];

    foreach ( $attributes as $attribute ) {
        if ( ! $attribute->get_visible() ) continue;

        if ( $attribute->is_taxonomy() ) {
            $terms = wc_get_product_terms( $product->get_id(), $attribute->get_name(), [ 'fields' => 'names' ] );
            $values = $terms;
        } else {
            $values = $attribute->get_options();
        }

        if ( ! empty( $values ) ) {
            $attr_items[] = implode( ', ', $values );
        }
    }

    $categories = wc_get_product_terms( $product->get_id(), 'product_cat', [ 'fields' => 'names' ] );
    if ( ! empty( $categories ) ) {
        array_unshift( $attr_items, implode( ', ', $categories ) );
    }
    ?>

    <?php if ( $attr_items ) : ?>
        <ul class="product-card__attrs">
            <?php foreach ( $attr_items as $i => $attr ) : ?>
                <li class="product-card__attr">
                    <?php if ( $i > 0 ) : ?>
                        <span class="product-card__dot" aria-hidden="true">&middot;</span>
                    <?php endif; ?>
                    <?php echo esc_html( $attr ); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if ( $title ) : ?>
        <h3 class="product-card__title | h6">
            <a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
        </h3>
    <?php endif; ?>

    <div class="product-card__footer">
        <?php if ( $price ) : ?>
            <p class="product-card__price"><?php echo wc_price( $price ); ?></p>
        <?php endif; ?>

        <?php woocommerce_template_loop_add_to_cart(); ?>
    </div>

</li>