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
