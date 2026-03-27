<?php

get_header();

$blocks = get_field('page-blocks');

if ($blocks):
    foreach ($blocks as $block):
        $layout = $block['acf_fc_layout'];

        get_template_part('template-parts/blocks/' . $layout, null, $block);
    endforeach;
endif;

get_footer();
