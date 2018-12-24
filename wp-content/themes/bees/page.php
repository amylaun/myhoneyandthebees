<? get_header(); ?>

    <div id="page" class="page-wrapper">
        About
        <?
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                the_content();
            } //endwhile
        } //end if
        ?>

    </div><!-- page-wrapper -->

<? get_footer(); ?>
