<?php

$image_position = get_array_value($args, 'image-text-image-position', get('image-text-image-position')) ?: 'left';
$image          = get_array_value($args, 'image-text-image', get('image-text-image'));
$text           = get_array_value($args, 'image-text-text', get('image-text-text'));

if (!$image && !$text) {
    return;
}

?>

<section class="image-text | section" data-image-position="<?php echo esc_attr($image_position); ?>">
    <div class="container">
        <div class="image-text__inner">

            <?php if ($image): ?>
                <figure class="image-text__media">
                    <?php echo wp_get_attachment_image($image, 'large', false, ['class' => 'image-text__img', 'loading' => 'lazy']); ?>
                </figure>
            <?php endif; ?>

            <?php if ($text): ?>
                <div class="image-text__content">
                    <?php echo wp_kses_post($text); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
