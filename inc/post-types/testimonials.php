<?php

add_action('init', function (): void {
    $labels = [
        'name'                  => _x('Testimonials', 'Post Type General Name', 'codelibry'),
        'singular_name'         => _x('Testimonial', 'Post Type Singular Name', 'codelibry'),
        'menu_name'             => __('Testimonials', 'codelibry'),
        'name_admin_bar'        => __('Testimonial', 'codelibry'),
        'archives'              => __('Testimonial Archives', 'codelibry'),
        'attributes'            => __('Testimonial Attributes', 'codelibry'),
        'parent_item_colon'     => __('Parent Testimonial:', 'codelibry'),
        'all_items'             => __('All Testimonials', 'codelibry'),
        'add_new_item'          => __('Add New Testimonial', 'codelibry'),
        'add_new'               => __('Add New', 'codelibry'),
        'new_item'              => __('New Testimonial', 'codelibry'),
        'edit_item'             => __('Edit Testimonial', 'codelibry'),
        'update_item'           => __('Update Testimonial', 'codelibry'),
        'view_item'             => __('View Testimonial', 'codelibry'),
        'view_items'            => __('View Testimonials', 'codelibry'),
        'search_items'          => __('Search Testimonial', 'codelibry'),
        'not_found'             => __('Not found', 'codelibry'),
        'not_found_in_trash'    => __('Not found in Trash', 'codelibry'),
        'featured_image'        => __('Featured Image', 'codelibry'),
        'set_featured_image'    => __('Set featured image', 'codelibry'),
        'remove_featured_image' => __('Remove featured image', 'codelibry'),
        'use_featured_image'    => __('Use as featured image', 'codelibry'),
        'insert_into_item'      => __('Insert into Testimonial', 'codelibry'),
        'uploaded_to_this_item' => __('Uploaded to this Testimonial', 'codelibry'),
        'items_list'            => __('Testimonials list', 'codelibry'),
        'items_list_navigation' => __('Testimonials list navigation', 'codelibry'),
        'filter_items_list'     => __('Filter Testimonials list', 'codelibry'),
    ];

    $args = [
        'label'               => __('Testimonials', 'codelibry'),
        'description'         => __('Testimonial post type', 'codelibry'),
        'labels'              => $labels,
        'supports'            => ['title'],
        'taxonomies'          => [],
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'show_in_rest'        => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    ];

    register_post_type('testimonials', $args);
});
