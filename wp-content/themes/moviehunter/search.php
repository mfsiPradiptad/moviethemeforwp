<?php

$s=get_search_query();

$args = array(
    'post_type' => array ( 'movies' ),
    's' => $s,
    'posts_per_page' => 10
);
$wp_query = new WP_Query($args);
set_query_var( 'result', $wp_query );

     if ( $wp_query->have_posts() ) :
       // get_template_part( 'content/page', 'search' );
        get_template_part('templates/content-page', 'search');

    endif; 

