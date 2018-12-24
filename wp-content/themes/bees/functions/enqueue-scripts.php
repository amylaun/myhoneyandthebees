<?php

/*
 * Enqueue Scripts
 *
 */

function is_admin_area() {
    if ( is_admin() )  {
        return true;
    }
    if ( strpos( $_SERVER['REQUEST_URI'], 'wp-login') != false ) {
        return true;
    }
}

if ( !is_admin_area() ) {

    /* Removing Wordpress Excess scripts and styles */
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );

    function switch_to_hosted_jquery() {
        wp_deregister_script('jquery');
        kiosk_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js',null, null, false, null);
        wp_enqueue_script('jquery');
    }
    add_action('init', 'switch_to_hosted_jquery');

    function site_scripts() {
        /* Site Specific Js and Css */
        kiosk_enqueue_script( 'siteJS', get_stylesheet_directory_uri().'/js/site.js', 'jquery', null,  true, '<div class="javascript-enable"><p>Please Enable Javascript</p></div><link rel="stylesheet" type="text/css" href="/wp-content/themes/theme_name/css/noscript.css">' );
        wp_enqueue_style( 'fontsGoogle', '//fonts.googleapis.com/css?family=Montserrat:300,400,500,700', null, null, false);
        wp_enqueue_style( 'fontsAdobe', '//use.typekit.net/ggv4rws.css', null, null, false);
        wp_enqueue_style( 'siteCSS', get_stylesheet_directory_uri().'/css/style.css', null, null, false);

        /* Other Added JS and CSS */
        //wp_register_script( 'example', get_stylesheet_directory_uri().'/js/example.js', 'jquery', null,  true, 'noscript string' );

        /* Removing Wordpress Excess scripts and styles */
        wp_deregister_script( 'wp-embed' );
        wp_dequeue_script( 'jquery-ui-core' );
    }
    add_action( 'wp_enqueue_scripts', 'site_scripts' );

    /* function to add async/defer/noscript to all scripts */
    add_filter( 'script_loader_tag', function ( $tag, $handle ) {
        global $noscripts;
        if (
            strpos($handle, 'jquery') === false &&
            strpos($handle, 'gform_') === false
        ) {
            if ( array_key_exists( $handle, $noscripts ) ) {
                $tag = str_replace( '></script>', '></script><noscript>' . $noscripts[$handle] . '</noscript>', $tag );
            }
        }
        return $tag;
    }, 10, 2 );

    function kiosk_enqueue_script($handle,$src,$dependent,$version,$footer,$noscript){
        global $noscripts;
        wp_enqueue_script($handle,$src,$dependent,$version,$footer);
        if ( isset( $noscript ) ){
            $noscripts[$handle] = $noscript;
        }
    }
    function kiosk_register_script($handle,$src,$dependent,$version,$footer,$noscript){
        global $noscripts;
        wp_register_script($handle,$src,$dependent,$version,$footer);
        if ( isset( $noscript ) ){
            $noscripts[$handle] = $noscript;
        }
    }

}
