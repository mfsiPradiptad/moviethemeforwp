<div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
    <div class="w3_agile_featured_movies">
        
    <?php
        while ($result->have_posts() ): $result->the_post();
    ?>
        <div class="col-md-2 w3l-movie-gride-agile">
            <?php 
            if ( has_post_thumbnail( $post->ID ) ) { 
                $url =  get_the_post_thumbnail_url($post->ID, 'movie-thumb' );
            } else {
                $url = get_bloginfo('template_directory') . '/assets/dist/images/blanck-movie.jpg';
            }
            ?>
            <a href="<?php echo the_permalink() ?>" class="hvr-shutter-out-horizontal">
                <img src="<?php echo $url; ?>" title="album-name" class="img-responsive" alt="<?php echo $post->the_title; ?>"/>
                <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
            </a>
            <div class="mid-1 agileits_w3layouts_mid_1_home">
                <div class="w3l-movie-text">
                    <h6><a href="<?php echo the_permalink() ?>"><?php echo $post->the_title; ?></a></h6>							
                </div>
                <div class="mid-2 agile_mid_2_home">
                    <?php
                    $year = get_post_meta( $post->ID, 'movie_year' );
                    $year = date( "Y", strtotime( $year[0] ) );
                    ?>
                    <p><?php echo $year; ?></p>

                    <div class="block-stars">
                    <?php 
                    if ( shortcode_exists( 'wppr_avg_rating' ) ) {
                         echo do_shortcode( "[wppr_avg_rating]" );

                    } else {
                    ?>
                        <ul class="w3l-ratings">
                            <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                        </ul>
                    <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="ribben">
                <p>NEW</p>
            </div>
        </div>

    <?php
        endwhile; wp_reset_postdata();
    ?>
        <div class="clearfix"> </div>
    </div>
</div>