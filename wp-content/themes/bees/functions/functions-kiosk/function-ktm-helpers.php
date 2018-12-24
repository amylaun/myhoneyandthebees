<?
// Meta Check
if ( ! function_exists('ktm_check_meta') ) {
    function ktm_check_meta( $meta, $key ) {
        return isset( $meta[ $key ] ) && $meta[ $key ] != '';
    }
}
// Meta Get
if ( ! function_exists('ktm_get_meta') ) {
    function ktm_get_meta( $meta, $key, $default='' ) {
        return ktm_check_meta( $meta, $key ) ? $meta[ $key ] : $default;
    }
}
// ACF Meta Check
if ( ! function_exists('ktm_acf_meta') ) {
    function ktm_acf_meta( $selector, $default, $post_id=null, $format_value=true ) {
        $field = get_field( $selector, $post_id, $format_value );
        return $field ? $field : $default;
    }
}
// Error Logging
if ( ! function_exists('write_log') ) {
    function write_log ( $log )  {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }
}
?>
