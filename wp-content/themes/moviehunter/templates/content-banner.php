<?php 
    $args = array (
        'post_type' => 'movies',
        'post_status' => 'publish',
        'posts_per_page' => '5',
        'meta_key' => 'featured_banner_hidden',
        'meta_value' => '1',
    );

    $result = new WP_Query( $args );

    if ( $result->have_posts() ):
        ?>
        <div id="slidey" style="display:none;">
            <ul>
                <?php
                while( $result->have_posts() ) : $result->the_post();
                    $banner_image = get_post_meta(get_the_ID(), 'movies_banner_image');
                ?>
                
                <li>
                    <img src="<?php echo $banner_image[0]['url']; ?>" alt="<?php echo $post->post_title; ?>">
                    <p class='title'><a href="<?php echo the_permalink(); ?>" class="a-color"><?php echo $post->post_title; ?></a></p>
                    <p class='description'><?php echo $post->post_excerpt; ?> </p>
                </li>
                <?php endwhile; endif; wp_reset_postdata();?>
            </ul>   	
        </div>

