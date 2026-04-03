<?php

$anchor_id = get_array_value($args, 'anchor-id', get('anchor-id'));
$title    = get_array_value($args, 'testimonials-title', get('testimonials-title'));
$subtitle = get_array_value($args, 'testimonials-subtitle', get('testimonials-subtitle'));
$button   = get_array_value($args, 'testimonials-button', get('testimonials-button'));

$testimonials = get_posts([
    'post_type'      => 'testimonials',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
]);

if (empty($testimonials)) {
    return;
}

?>

<section class="testimonials | section"<?php echo $anchor_id ? ' id="' . esc_attr($anchor_id) . '"' : ''; ?>>
    <div class="container">

        <?php get_template_part('template-parts/parts/section-header', null, [
            'title'    => $title,
            'subtitle' => $subtitle,
            'button'   => $button,
        ]); ?>

        <div class="testimonials__slider swiper">
            <div class="swiper-wrapper">
                <?php foreach ($testimonials as $testimonial): ?>
                    <?php
                        $author_name     = get_field('author-name', $testimonial->ID);
                        $author_position = get_field('author-position', $testimonial->ID);
                        $content         = get_field('content', $testimonial->ID);
                    ?>
                    <div class="testimonials__slide swiper-slide">
                        <?php if ($content): ?>
                            <div class="testimonials__content"><?php echo wp_kses_post($content); ?></div>
                        <?php endif; ?>
                        <div class="testimonials__author">
                            <?php if ($author_name): ?>
                                <span class="testimonials__author-name"><?php echo esc_html($author_name); ?></span>
                            <?php endif; ?>
                            <?php if ($author_position): ?>
                                <span class="testimonials__author-position"><?php echo esc_html($author_position); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="testimonials__pagination swiper-pagination"></div>
        </div>

    </div>
</section>
