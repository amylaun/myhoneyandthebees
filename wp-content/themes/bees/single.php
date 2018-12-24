<? get_header(); ?>

    <div id="single" class="page-wrapper"> <?
        
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post(); 
                the_content();
            } //endwhile
        } //endif
    
    ?> </div><!-- page-wrapper -->
    
<? get_footer(); ?>