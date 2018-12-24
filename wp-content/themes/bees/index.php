<? get_header(); ?>

    <div class="page-wrapper">
        <?
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                the_content();
            } //endwhile
        } //end if
        ?>

    </div>

<? get_footer(); ?>
