<?php
$anchor_id = get_array_value($args, 'anchor-id', get('anchor-id'));
$users = get_array_value($args, 'users_item', get('users_item'));

if ($users): ?>
    <section class="users-section | section"<?php echo $anchor_id ? ' id="' . esc_attr($anchor_id) . '"' : ''; ?>>
        <div class="container">
            <div class="grid" data-columns="2">

                <?php foreach ($users as $user): 
                    $image_id = $user['image'];
                    $title    = $user['title'];
                    $text     = $user['text'];
                    $button   = $user['button'];
                ?>
                    <div class="user-card">
                        <?php if ($image_id): ?>
                            <div class="user-card__image">
                                <?php echo wp_get_attachment_image($image_id, 'medium'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="user-card__content">
                            <?php if ($title): ?>
                                <h2 class="user-card__title"><?php echo esc_html($title); ?></h2>
                            <?php endif; ?>

                            <?php if ($text): ?>
                                <div class="user-card__text | content">
                                    <?php echo wp_kses_post($text); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($button): ?>
                                <a class="button button--secondary" 
                                href="<?php echo esc_url($button['url']); ?>" 
                                target="<?php echo esc_attr($button['target'] ?: '_self'); ?>">
                                    <?php echo esc_html($button['title']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>
<?php endif; ?>