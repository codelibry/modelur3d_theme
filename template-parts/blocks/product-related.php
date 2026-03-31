<?php
global $product;

if ( ! $product instanceof WC_Product ) {
    $cart = WC()->cart ? WC()->cart->get_cart() : [];

    foreach ( $cart as $cart_item ) {
        if ( ! empty( $cart_item['data'] ) && $cart_item['data'] instanceof WC_Product ) {
            $product = $cart_item['data'];
            break;
        }
    }
}

if ( ! $product instanceof WC_Product ) {
    return;
}

$limit = 4;
$title = get_array_value( $args, 'title' );

$related_ids = wc_get_related_products( $product->get_id(), $limit );

if ( count( $related_ids ) < $limit ) {
    $diff = $limit - count( $related_ids );

    $filler_ids = wc_get_products( [
        'status'  => 'publish',
        'limit'   => $diff + 1,
        'exclude' => array_merge( $related_ids, [ $product->get_id() ] ),
        'return'  => 'ids',
        'orderby' => 'date',
        'order'   => 'DESC',
    ] );

    $related_ids = array_merge( $related_ids, $filler_ids );
}

$related_ids = array_slice( $related_ids, 0, $limit );

if ( ! empty( $related_ids ) ) : ?>

<section class="product-tab | section">
    <div class="container">
        <div class="product-tab__top | repel">
            <?php if ( $title ) : ?>
                <h2><?php echo esc_html( $title ); ?></h2>
            <?php endif; ?>
            <a class="button" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
                Show All
            </a>
        </div>

        <div class="product-tab__content">
            <ul class="products-grid products">
                <?php
                foreach ( $related_ids as $related_id ) :
                    $post_object = get_post( $related_id );
                    setup_postdata( $GLOBALS['post'] =& $post_object );
                    wc_get_template_part( 'content', 'product' );
                endforeach;
                wp_reset_postdata();
                ?>
            </ul>
        </div>
    </div>
</section>

<?php endif; ?>