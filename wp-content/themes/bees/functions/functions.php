<?

function get_default_post_thumbnail() {
    $images = array(
        get_stylesheet_directory_uri() . '/images/defaults/default-1.jpg',
        get_stylesheet_directory_uri() . '/images/defaults/default-2.jpg',
    );
    $image = array_rand($images);
    return '<img src="' . $images[ $image ] . '" class="">';
}
