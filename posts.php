<?php
// Resources
register_post_type(
    'global-module',
    array(
        'labels' => array(
            'name' => 'Global Modules',
            'singular_name' => 'Global Module',
            'add_new' => 'Add New Module',
            'add_new_item' => 'Add New Module',
            'edit' => 'Edit Module',
            'edit_item' => 'Edit Module',
            'new_item' => 'New Module',
            'view' => 'View Module',
            'view_item' => 'View Module',
            'search_items' => 'Search Modules',
            'not_found' => 'No Module found',
            'not_found_in_trash' => 'No Module found in Trash'
        ),
        'public' => true,
        'supports' => array('title', 'revision'),
        'menu_icon' => 'dashicons-media-default',
        'taxonomies' => array(),
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('with_front' => false, 'slug' => 'global-module'),
        'capability_type' => 'post',
        'has_archive' => false
    )
);

//Career Types
// Resources Category
register_taxonomy(
    'module-types',
    array('global-module'),
    array(
        'hierarchical' => true,
        'labels' => array(
            'name' => 'Module Types',
            'menu_name' => 'Module Types',
            'singular_name' => 'Module Type',
            'search_items' => 'Search Module Types',
            'all_items' => 'All Module Types',
            'parent_item' => 'Parent Module Types',
            'parent_item_colon' => 'Parent Module Types:',
            'edit_item' => 'Edit Module Type',
            'update_item' => 'Update Module Type',
            'add_new_item' => 'Add New Module Type',
            'new_item_name' => 'New Module Type',
        ),
        'public' => false,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'global-module')
    )

);


