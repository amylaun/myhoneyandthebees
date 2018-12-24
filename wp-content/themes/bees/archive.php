<? get_header(); ?>

    <div id="archive" class="page-wrapper">
        Archive
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
