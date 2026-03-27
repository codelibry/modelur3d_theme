<?php

$image = get_array_value($args, 'image');
$title = get_array_value($args, 'title');
$description = get_array_value($args, 'description');

?>

<section class="shop-banner | section">
    <?php if($image): ?>
        <?php echo wp_get_attachment_image($image, 'large', false, [
            'loading' => false,
            'decoding' => 'sync',
            'fetchpriority' => 'high',
            'class' => 'shop-banner__image'
        ]) ?>
    <?php endif; ?>

    <div class="shop-banner__container | container flow">
        <?php if ( function_exists( 'woocommerce_breadcrumb' ) ) {
            woocommerce_breadcrumb([
                'wrap_before' => '<nav class="woocommerce-breadcrumb">',
                'wrap_after'  => '</nav>',
                'before'      => '',
                'after'       => '',
                'home'        => _x( 'Home', 'breadcrumb', 'codelibry' ),
            ]);
        } ?>

        <?php if($title): ?>
            <h1 class="shop-banner__title">
                <?php echo $title ?>
            </h1>
        <?php endif; ?>

        <?php if($description): ?>
            <div class="shop-banner__description">
               <?php echo $description ?>
            </div>
        <?php endif; ?>
    </div>
</section>
