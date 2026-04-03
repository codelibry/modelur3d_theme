<?php

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}

$image_id   = $product->get_image_id();
$title      = $product->get_name();
$price      = $product->get_price();
$permalink  = get_permalink( $product->get_id() );
$attributes = $product->get_attributes();

?>

<li <?php wc_product_class( 'product-card', $product ); ?>>

    <a href="<?php echo esc_url( $permalink ); ?>" aria-label="<?php echo esc_attr( $title ); ?>" class="product-card__thumbnail">
        <?php if ( $image_id ) : ?>

            <?php echo wp_get_attachment_image( $image_id, 'medium', false, [ 'loading' => 'lazy' ] ); ?>

        <?php else : ?>
            <?php
            $placeholder_id  = (int) get_option( 'woocommerce_placeholder_image', 0 );
            $placeholder_src = wc_placeholder_img_src( 'medium' );
            ?>
            <?php if ( $placeholder_id > 0 ) : ?>

                <?php echo wp_get_attachment_image( $placeholder_id, 'medium', false, [
                    'loading' => 'lazy',
                    'class'   => 'product-card__placeholder',
                    'alt'     => '',
                ] ); ?>

            <?php else : ?>

                <img
                    src="<?php echo esc_url( $placeholder_src ); ?>"
                    alt=""
                    class="product-card__placeholder"
                    loading="lazy"
                >

            <?php endif; ?>
        <?php endif; ?>

        <div class="product-card__icon-link">
            <?php echo get_inline_svg( 'go-to' ); ?>
        </div>
    </a>

    <?php
    $attr_items = [];

    foreach ( $attributes as $attribute ) {
        if ( ! $attribute->get_visible() ) continue;

        if ( $attribute->is_taxonomy() ) {
            $values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), [ 'fields' => 'names' ] );
        } else {
            $values = $attribute->get_options();
        }

        if ( ! empty( $values ) ) {
            array_push( $attr_items, ...$values );
        }
    }

    $categories = wc_get_product_terms( $product->get_id(), 'product_cat', [ 'fields' => 'names' ] );
    if ( ! empty( $categories ) ) {
        array_unshift( $attr_items, ...$categories );
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