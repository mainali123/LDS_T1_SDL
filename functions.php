<?php
function custom_theme_enqueue_styles()
{
    wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css', array(), '1.0.0');
    wp_enqueue_style('fonts', get_template_directory_uri() . '/css/fonts.css', array(), '1.0.0');
    wp_enqueue_style('animation', get_template_directory_uri() . '/css/animation.css', array(), '1.0.0');
    wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css', array(), '1.0.0');
}

function custom_theme_enqueue_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('header', get_template_directory_uri() . '/component/header.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('footer', get_template_directory_uri() . '/component/footer.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'custom_theme_enqueue_styles', 10);
add_action('wp_enqueue_scripts', 'custom_theme_enqueue_scripts', 20);


// Register custom post type
function create_movie_post_type()
{
    $labels = array(
        'name' => _x('Movies', 'Post Type General Name', 'text_domain'),
        'singular_name' => _x('Movie', 'Post Type Singular Name', 'text_domain'),
        'menu_name' => _x('Movies', 'Admin Menu text' ,'text_domain'),
        'name_admin_bar' => _x('Movie', 'Add New on Tool', 'text_domain'),
        'add_new' => __('Add Movie', 'text_domain'),
        'add_new_item' => __('Add New Movie', 'text_domain'),
        'new_item' => __('New Movie', 'text_domain'),
        'edit_item' => __('Edit Movie', 'text_domain'),
        'view_item' => __('View Movie', 'text_domain'),
        'all_items' => __('All Movies', 'text_domain'),
        'search_items' => __('Search Movie', 'text_domain'),
        'not_found' => __('Not found', 'text_domain'),
        'not_found_in_trash' => __('Not found in trash', 'text_domain'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'public_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'movie'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
    );
    register_post_type('movie', $args);
}

add_action('init', 'create_movie_post_type');


// Register custom taxonomy
function create_movie_taxonomy()
{
    $labels = array(
        'name' => _x('Genres', 'Taxonomy General Name', 'text_domain'),
        'singular_name' => _x('Genre', 'Taxonomy Singular Name', 'text_domain'),
        'search_items' => __('Search Genres', 'text_domain'),
        'all_items' => __('All Genres', 'text_domain'),
        'parent_item' => __('Parent Genre', 'text_domain'),
        'edit_item' => __('Edit Genre', 'text_domain'),
        'update_item' => __('Update Genre', 'text_domain'),
        'add_new_item' => __('Add New Genre', 'text_domain'),
        'new_item_name' => __('New Genre Name', 'text_domain'),
        'menu_name' => __('Genre', 'text_domain'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'genre'),
    );
    register_taxonomy('genre', array('movie'), $args);
}

add_action('init', 'create_movie_taxonomy');
