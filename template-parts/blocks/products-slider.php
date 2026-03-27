<?php

$title = get_array_value($args, 'title');
$subtitle = get_array_value($args, 'subtitle');
$button = get_array_value($args, 'button');
$products = get_array_value($args, 'products', []);

if(empty($products)) return;

?>

<section class="products-slider | section">
    <div class="container flow">
        <div class="products-slider__header | repel">
            <div class="flow" style="--flow-space: 1rem;">
                <?php if($title): ?>
                    <h2 class="h3"><?php echo $title ?></h2>
                <?php endif; ?>

                <?php if($subtitle): ?>
                    <p><?php echo $subtitle ?></p>
                <?php endif; ?>
            </div>

            <?php if($button): ?>
                <a class="button" href="<?php echo $button['url'] ?>">
                  <?php echo $button['title'] ?>
                </a>
            <?php endif; ?>
        </div>

        <div class="slider-wrapper | flow">
            <div class="swiper">
                <ul class="swiper-wrapper">
                    <?php 
                        foreach ($products as $post):
                            setup_postdata($post);
                            global $product;
                            $product = wc_get_product($post->ID);
                            wc_get_template_part('content', 'product');
                        endforeach; 
                    wp_reset_postdata(); ?>
                </ul>
            </div>

            <div class="navigation | cluster">
                <button class="prev navigation-button button"><?php echo get_inline_svg('arrow-left') ?></button>
                <button class="next navigation-button button"><?php echo get_inline_svg('arrow-left') ?></button>
            </div>
        </div>
    </div>
</section>
