<?
// Theme Support
    function ktm_theme_setup() {
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'menus' );
        add_theme_support( 'widgets' );
        add_post_type_support( 'page', 'excerpt' );
    }
    add_action( 'after_setup_theme', 'ktm_theme_setup' );

    set_post_thumbnail_size( 600, 300, true );

    function custom_excerpt_length( $length ) {
        return 20;
    }
    add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// END / Theme Support
