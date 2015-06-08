<?php

/** @var  \Herbert\Framework\Application $container */

// Register Custom Post Type
function poster_cpt() {

    $labels = [
        'name'                => _x( 'MoCC Posters', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'MoCC Poster', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'MoCC Poster', 'text_domain' ),
        'name_admin_bar'      => __( 'MoCC Poster', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent MoCC Poster:', 'text_domain' ),
        'all_items'           => __( 'All MoCC Posters', 'text_domain' ),
        'add_new_item'        => __( 'Add New MoCC Poster', 'text_domain' ),
        'add_new'             => __( 'Add New', 'text_domain' ),
        'new_item'            => __( 'New MoCC Poster', 'text_domain' ),
        'edit_item'           => __( 'Edit MoCC Poster', 'text_domain' ),
        'update_item'         => __( 'Update MoCC Poster', 'text_domain' ),
        'view_item'           => __( 'View MoCC Poster', 'text_domain' ),
        'search_items'        => __( 'Search MoCC Posters', 'text_domain' ),
        'not_found'           => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
    ];
    $rewrite = [
        'slug'                => 'poster',
        'with_front'          => true,
        'pages'               => true,
        'feeds'               => true,
    ];
    $args = [
        'label'               => __( 'poster', 'text_domain' ),
        'description'         => __( 'List of MoCC Posters', 'text_domain' ),
        'labels'              => $labels,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'taxonomies'          => array( 'category', 'post_tag' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'rewrite'             => $rewrite,
        'capability_type'     => 'page',
    ];
    register_post_type( 'poster', $args );

}

// Hook into the 'init' action
add_action( 'init', 'poster_cpt', 0 );
