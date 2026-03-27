<?php
$text = get_array_value($args, 'banner-text', get('banner-text'));
$title = get_array_value($args, 'banner-title', get('banner-title'));
$button   = get_array_value($args, 'banner-button', get('banner-button'));
$image_id = get_array_value($args, 'banner-image', get('banner-image'));


$bg_style = '';
if ($image_id) {
    $image_url = wp_get_attachment_image_url($image_id, 'full');
    $bg_style = ' style="background-image: url(' . esc_url($image_url) . ');"';
}

?>

<section class="banner | section">
    <div class="container ">
        <div class="banner__wrapper"<?php echo $bg_style; ?>">
            <div class="banner__content">
                <?php if ($title): ?>
                    <h1>
                        <?php echo wp_kses_post($title); ?>
                    </h1>
                <?php endif; ?>

                <?php if ($text): ?>
                    <div class="banner__text">
                        <?php echo wp_kses_post($text); ?>
                    </div>
                <?php endif; ?>

                <?php if ($button): 
                    $url    = $button['url'] ?? '#';
                    $label  = $button['title'] ?? 'Learn More';
                    $target = $button['target'] ?: '_self';
                    ?>
                    <a class="button button--secondary" 
                    href="<?php echo esc_url($url); ?>" 
                    target="<?php echo esc_attr($target); ?>">
                        <?php echo esc_html($label); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>