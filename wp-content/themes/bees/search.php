<? get_header(); ?>
<div id="search" class="page-wrapper">
<?   
    $s = '';
    
    if ( isset( $_GET["s"] ) ) {
        $s = $_GET["s"];
    }
            
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
        'posts_per_page' => 10,
        's' => $s,
        'paged' => $paged
    );
    
    $s = strip_tags( $s );
    
    $the_query = new WP_Query( $args );
            
    if ( ( $s != '' ) && $the_query->have_posts() ) { 
        echo '<h1>Search results for ' . $s . '</h1>';
        while ( $the_query->have_posts() ) : $the_query->the_post();
            echo '<a href="'. get_the_permalink() .'">';
                echo '<div class="search-item-wrapper">';
                    echo '<h2>'. get_the_title() .'</h2>';
                    echo '<p>'. the_excerpt() .'</p>';
                echo '</div>';
            echo '</a>';
        endwhile; ?>
        
        <div class="pagination">
            <div class="nav-next alignright"><?php previous_posts_link( 'View previous posts' ); ?></div>
            <div class="nav-previous alignleft"><?php next_posts_link( 'View more posts' ); ?></div>
        </div>
        
    <?php } else { ?>
        <p>Sorry, but nothing matched your search criteria.<br>Please try again with some different keywords.</p>
    <?php } ?>  

</div><!-- page-wrapper -->

<?php get_footer(); ?>
