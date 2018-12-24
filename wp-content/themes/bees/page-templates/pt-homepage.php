<?php
/*
 Template Name: Homepage
*/
?>
<?php get_header(); ?>

    <div class="home">
        <div class="gallery">

        </div>
        <div class="posts add-pad">
            <h2 class="h2-title">Latest Posts</h2>
            <? $latest_posts = new WP_Query(array(
                'posts_per_page' => 4,
            )); ?>
            <? if ( $latest_posts->have_posts() ) {
                echo '<div class="grid--wrap gutters">';
                while ( $latest_posts->have_posts() ) {
                    $latest_posts->the_post(); ?>
                    <div class="col-1-2 add-pad--little post">
                        <div class="featured-image">
                            <a href="<?= get_the_permalink(); ?>">
                                <? if ( has_post_thumbnail() ) {
                                    echo get_the_post_thumbnail();
                                } else {
                                    echo get_default_post_thumbnail();
                                } ?>
                            </a>
                        </div>
                        <a href="<?= get_the_permalink(); ?>">
                            <p><strong><?= get_the_title(); ?></strong></p>
                        </a>
                        <p class="small"><?= get_the_excerpt(); ?></p>
                        <a href="<?= get_the_permalink(); ?>" class="h2 post-url underline">Continue Reading</a>
                    </div>

                <? }
                echo '</div>';
            } ?>
        </div>
        <div class="about add-pad">
            <h2 class="h2-title">About Me</h2>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/beekeepers.jpg" width="90" alt="" class="add-pad--little pad-btm-0">
            <p class="small"><br>Wife, mother, daughter, sis, auntie, friend, Grandma, Beekeeper, Former Dean, Library Services, PCC</p>
        </div>
    </div>

<?php get_footer();?>
