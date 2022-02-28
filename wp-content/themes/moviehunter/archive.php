<?php 
if ( have_posts() ) :
    $post_type = get_post_type();
    get_template_part('templates/content-archive', $post_type);
endif;