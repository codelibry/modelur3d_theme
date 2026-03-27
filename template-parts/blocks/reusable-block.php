<?php

$post_id = $args['reusable-block-post'] ?? null;

if (!$post_id) {
    return;
}

$blocks = get_field('reusable-blocks', $post_id);

if (empty($blocks)) {
    return;
}

foreach ($blocks as $block):
    $layout = $block['acf_fc_layout'];

    get_template_part('template-parts/blocks/' . $layout, null, $block);
endforeach;
