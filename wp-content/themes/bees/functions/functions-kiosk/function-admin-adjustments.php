<?
// Login Page Logo
    function admin_login_style() {
        wp_enqueue_style( 'core', get_stylesheet_directory_uri() . '/css/admin.css', false );
    }
    add_action( 'login_enqueue_scripts', 'admin_login_style', 10 );
    //add_action( 'admin_enqueue_scripts', 'admin_login_style', 10 );
// END / Login Page Logo

// Remove Appearance < Editor from admin menu
    function my_remove_menu_elements() {
       remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
    }
    add_action('admin_init', 'my_remove_menu_elements');

    function remove_menu_items() {
        remove_menu_page( 'edit-comments.php' );
        remove_action('admin_menu', '_add_themes_utility_last', 101);
    }
    add_action('admin_menu', 'remove_menu_items', 1);
// END / Remove Appearance < Editor from admin menu

// Show Page Templates in Admin columns
    add_filter( 'manage_pages_columns', 'page_column_views' );
    add_action( 'manage_pages_custom_column', 'page_custom_column_views', 5, 2 );
    function page_column_views( $defaults ){
        $defaults['page-layout'] = __('Template');
        return $defaults;
    }
    function page_custom_column_views( $column_name, $id ) {
        if ( $column_name === 'page-layout' ) {
            $set_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
            if ( $set_template == 'default' ) {
                echo 'Default';
            }
            $templates = get_page_templates();
            ksort( $templates );
            foreach ( array_keys( $templates ) as $template ) :
                if ( $set_template == $templates[$template] ) echo $template;
            endforeach;
        }
    }
// END / Show Page Templates in Admin columns

// Allow SVG Uploads in the Media Library
    function svg_upload_helper( $data, $file, $filename, $mimes ) {
        $wp_filetype = wp_check_filetype( $filename, $mimes );

        $ext = $wp_filetype['ext'];
        $type = $wp_filetype['type'];
        $proper_filename = $data['proper_filename'];

        return compact( 'ext', 'type', 'proper_filename' );
    }
    add_filter( 'wp_check_filetype_and_ext', 'svg_upload_helper', 10, 4 );
    function cc_mime_types($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
    add_filter('upload_mimes', 'cc_mime_types');
// END / Allow SVG Uploads in the Media Library

// Security Updates
    // Login Page: Remove Hints
    function ktm_update_wordpress_errors(){
        return 'Invalid username or password.';
    }
    add_filter( 'login_errors', 'ktm_update_wordpress_errors' );
    // END / Login Page: Remove Hints

    // Remove version generator
        remove_action('wp_head','wp_generator');
    // END / Remove version generator

// END / Security Updates

?>
