<?php


function theme_child_enqueue_scripts() {
    wp_enqueue_script(
        'theme-child-main',
        get_stylesheet_directory_uri() . '/js/main.js',
        array( 'jquery' ),
        '1.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'theme_child_enqueue_scripts', 999 );

require_once( get_stylesheet_directory(). '/checkout.php' );