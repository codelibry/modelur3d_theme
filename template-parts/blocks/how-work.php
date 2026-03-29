<?php

$title    = get_array_value($args, 'how-title', get('how-title'));
$main_text = get_array_value($args, 'how-text', get('how-text'));
$image_id = get_array_value($args, 'how-image', get('how-image'));
$items    = get_array_value($args, 'how_item', get('how_item'));
?>

<section class="how-work | section">
    <div class="container-sm">
        <div class="how-work__top">
            <?php if ($title) : ?>
                <h2 class="how-work__title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <?php if ($main_text) : ?>
                <div class="how-work__description">
                    <?php echo wp_kses_post($main_text); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="how-work__content">
            <div class="how-work__items">
                <?php if (!empty($items)) : ?>
                    <?php foreach ($items as $item) : 
                        $icon = $item['icon']; 
                        $item_text = $item['text'];
                    ?>
                        <div class="how-work__item">
                            <?php if ($icon) : ?>
                                <div class="how-work__item-icon">
                                    <?php 
                                    $file_path = get_attached_file($icon['id']);
                                    $file_ext  = pathinfo($file_path, PATHINFO_EXTENSION);

                                    if ($file_ext === 'svg' && file_exists($file_path)) {
                                        echo file_get_contents($file_path);
                                    } else {
                                        echo wp_get_attachment_image($icon['id'], 'thumbnail');
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($item_text) : ?>
                                <div class="how-work__item-text">
                                    <?php echo wp_kses_post($item_text); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="how-work__media">
                <?php if ($image_id) : ?>
                    <?php echo wp_get_attachment_image($image_id, 'full', false, ['class' => 'how-work__image']); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>