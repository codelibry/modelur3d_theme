<?php

$title    = get_array_value($args, 'title');
$subtitle = get_array_value($args, 'subtitle');
$button   = get_array_value($args, 'button');

if (!$title && !$subtitle && !$button) {
    return;
}

?>

<div class="section-header">
    <?php if ($title): ?>
        <h2 class="section-header__title"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>
    <?php if ($subtitle): ?>
        <p class="section-header__subtitle"><?php echo esc_html($subtitle); ?></p>
    <?php endif; ?>
    <?php if ($button && !empty($button['url'])): ?>
        <a class="section-header__button | button"
           href="<?php echo esc_url($button['url']); ?>"
           <?php if (!empty($button['target'])) echo 'target="' . esc_attr($button['target']) . '"'; ?>>
            <?php echo esc_html($button['title']); ?>
        </a>
    <?php endif; ?>
</div>
