<?php
/*
 replace file/path/code with your shortcode functional
*/

function shortcode_example_callback($atts) {
    $params = shortcode_atts(
        array(
                'option' => true
        ),
        $atts
    );

    ob_start();

    $html = ob_get_clean();

    return $html;
}

add_shortcode('shortcode_example', 'shortcode_example_callback');
