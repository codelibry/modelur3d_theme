<?php
/*
 replace file/path/code with your ajax functional
*/

function ajax_example_callback() {
    wp_die();
}

add_action('wp_ajax_ajax_example', 'ajax_example_callback');
add_action('wp_ajax_nopriv_ajax_example', 'ajax_example_callback');