<?
// GRAVITY FORMS HOOKS //
    if ( class_exists( 'GFCommon' ) ) {
        add_filter( 'gform_field_validation', 'validate_phone', 10, 4 );
        add_filter( 'gform_upload_root_htaccess_rules', '__return_false' );
        add_filter( 'gform_ajax_spinner_url', 'spinner_url', 10, 2);
        //add_filter( 'gform_confirmation_anchor', '__return_true' );
        //add_filter( 'gform_validation_anchor', '__return_true' );
    }

    // GRAVITY FORM LOADER
    function spinner_url($image_src, $form){
        return  get_stylesheet_directory_uri() . '/images/loading.svg';
    }

    // Custom Phone Validation and Accessibility
    function validate_phone( $result, $value, $form, $field ) {
        $pattern = "/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/";

        if ( $field->type == 'phone' && $field->phoneFormat != 'standard' && ! preg_match( $pattern, $value ) && ( strpos($field->cssClass, 'validate-phone') !== false ) ) {
               $result['is_valid'] = false;
                  $result['message']  = 'Please enter a valid phone number';
        }

        return $result;
    }
// END / GRAVITY FORMS HOOKS //
?>
