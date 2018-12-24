<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <?php include( get_template_directory() . '/inc/wp-header-content.php' ); ?>
    <?php wp_head(); ?>
    <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/favicon-16x16.png" sizes="16x16" />

    <?php // Please call script and stylesheets from /functions/enqueue-scripts.php /?>

    <!-- Fonts -->

</head>

<body <?php body_class(); ?>>
    <header>
        <a href="<?= get_home_url(); ?>" title="Home" class="logo">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" alt="My Honey and the Bees">
        </a>
        <?= wp_nav_menu(array('menu' => 'Main Menu', 'container' => false, 'menu_class' => 'site-menu')); ?>
        <a href="https://www.facebook.com/profile.php?id=678663570" target="_blank" class="icon"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/facebook.svg" alt="Facebook"></a>
    </header>
    <main>
