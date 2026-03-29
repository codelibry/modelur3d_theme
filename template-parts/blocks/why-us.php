<?php

$title    = get_array_value($args, 'why-title', get('why-title'));
$items    = get_array_value($args, 'why_item', get('why_item'));
?>

<section class="why-us | section">
    <div class="container">
        <div class="why-us__top">
            <?php if ($title) : ?>
                <h2 class="why-us__title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
        </div>


        <div class="why-us__items | grid">
            <?php if (!empty($items)) : ?>
                <?php foreach ($items as $item) : 
                    $item_text = $item['text'];
                ?>
                    <div class="why-us__item">
                        <?php if ($item_text) : ?>
                            <div class="why-us__item-text">
                                <?php echo wp_kses_post($item_text); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</section>