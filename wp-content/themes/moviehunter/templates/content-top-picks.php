<?php
    $args = array (
        'post_type' => 'movies',
        'post_status' => 'publish',
        'posts_per_page' => '10',
        'meta_key' => 'top_picks_movies_hidden',
        'meta_value' => '1'
    );

    $result = new WP_Query( $args );

    if ( $result->have_posts() ):
?>
	<div class="banner-bottom">
		<div class="row row-mod">
			<div class="col-sm-12">
				<h4 class="latest-text w3_latest_text">Weekly Top Picks</h4> 
				
			</div>
		</div>
		<div class="container">
			<div class="w3_agile_banner_bottom_grid">
				<div id="owl-demo" class="owl-carousel owl-theme">
					<?php while ( $result->have_posts() ): $result->the_post(); ?>
					<div class="item">
						<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
						<?php 
						if ( has_post_thumbnail( $post->ID ) ) { 
							$url =  get_the_post_thumbnail_url($post->ID, 'movie-thumb' );
						} else {
							$url = get_bloginfo('template_directory') . '/assets/dist/images/blanck-movie.jpg';
						}
						?>
							<a href="<?php echo the_permalink() ?>" class="hvr-shutter-out-horizontal">
								<img src="<?php echo $url; ?>" title="<?php echo $post->post_title; ?>" class="img-responsive" alt="image"/>
								<div class="w3l-action-icon">
									<i class="fa fa-play-circle" aria-hidden="true"></i>
								</div>
							</a>
							<div class="mid-1 agileits_w3layouts_mid_1_home">
								<div class="w3l-movie-text">
									<h6><a href="<?php echo the_permalink() ?>"><?php echo $post->post_title; ?></a></h6>							
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

										} else { ?>
										<ul class="w3l-ratings">
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
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
					</div>

					<?php endwhile; ?>
				</div>
			</div>			
		</div>
	</div>

<?php 
endif;
wp_reset_postdata();