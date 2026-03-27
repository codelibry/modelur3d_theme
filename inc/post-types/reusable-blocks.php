<?php

add_action('init', function (): void {
    $labels = [
        'name'                  => _x('Reusable Blocks', 'Component Post Type', 'codelibry'),
        'singular_name'         => _x('Reusable Blocks', 'Component Post Type', 'codelibry'),
        'menu_name'             => _x('Reusable Blocks', 'Component Post Type', 'codelibry'),
        'name_admin_bar'        => __('Reusable Blocks', 'codelibry'),
        'archives'              => __('Reusable Block Archives', 'codelibry'),
        'attributes'            => __('Reusable Block Attributes', 'codelibry'),
        'parent_item_colon'     => __('Parent Reusable Block:', 'codelibry'),
        'all_items'             => __('All Reusable Blocks', 'codelibry'),
        'add_new_item'          => __('Add New Reusable Blocks', 'codelibry'),
        'new_item'              => __('New Reusable Blocks', 'codelibry'),
        'edit_item'             => __('Edit Reusable Blocks', 'codelibry'),
        'update_item'           => __('Update Reusable Blocks', 'codelibry'),
        'view_item'             => __('View Reusable Blocks', 'codelibry'),
        'view_items'            => __('View Reusable Blocks', 'codelibry'),
        'search_items'          => __('Search Reusable Blocks', 'codelibry'),
        'not_found'             => __('No reusable blocks found', 'codelibry'),
        'not_found_in_trash'    => __('No reusable blocks found in Trash', 'codelibry'),
        'items_list'            => __('Reusable blocks list', 'codelibry'),
        'items_list_navigation' => __('Reusable blocks list navigation', 'codelibry'),
        'filter_items_list'     => __('Filter reusable blocks list', 'codelibry'),
    ];

    $args = [
        'labels'                => $labels,
        'supports'              => ['title'],
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-controls-repeat',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'capability_type'       => 'page',
        'rewrite'               => false
    ];

    register_post_type('reusable-blocks', $args);
});
