<?php get_header(); ?>

<div class="single-page-agile-main">
<div class="container">
		<!-- /w3l-medile-movies-grids -->
			<div class="agileits-single-top">
				<ol class="breadcrumb">
				  <li><a href="<?php echo get_bloginfo('url'); ?>">Home</a></li>
				  <li class=""><a href="<?php echo get_post_type_archive_link('movies'); ?>"><?php echo ucwords($post_type); ?></a></li>
				  <li class="active"><?php echo $post->post_title; ?></li>
				</ol>
			</div>
			<div class="single-page-agile-info">
                   <!-- /movie-browse-agile -->
                           <div class="show-top-grids-w3lagile">
				<div class="col-sm-8 single-left">
					<div class="song">
						<div class="song-info">
							<h3><?php echo $post->post_title; ?></h3>	
					    </div>
                        <?php
                            if ( has_post_thumbnail( $post->ID ) ) { 
                                $url =  get_the_post_thumbnail_url($post->ID, 'movie-thumb' );
                            } else {
                                $url = get_bloginfo('template_directory') . '/assets/dist/images/blanck-movie.jpg';
                            }
                            $year = get_post_meta( $post->ID, 'movie_year' );
                            $year = date( "Y", strtotime( $year[0] ) );
                        ?>
						<div class="video-grid-single-page-agileits">
							<div class="col-sm-4 text-center">
								<img src="<?php echo $url; ?>" title="<?php echo $post->post_title; ?>" class="" alt="image"/>
                            </div>
                            <div class="col-sm-4">
                                <p> Director : <span class="glb-color"> <?php echo get_post_meta($post->ID, 'movie_director', true); ?> </span> </p>
                                <p> Release Year : <span class="glb-color"> <?php echo $year; ?> </span> </p>
                                <p> Writer : <span class="glb-color"> <?php echo get_post_meta($post->ID, 'movie_writer', true); ?> </span> </p>
                                <p> Stars : <span class="glb-color"> <?php echo get_post_meta($post->ID, 'movie_stars', true); ?> </span> </p>
                                <?php $terms = get_the_terms($post, 'genres'); 
                                if (! empty ($terms )) :
                                    $tax_arr = array();
                                    foreach ( $terms as $term ) : 
                                        $tax_arr[] = '<a class="glb-color" href="'. get_term_link($term->slug, 'genres') . '">' . $term->name . "</a>"; 
                                    endforeach; 
                                    $str = implode( ", ", $tax_arr );
                                ?>
                                <p> Genres : <span class="glb-color"> <?php echo $str; ?> </span> </p>
                                <?php endif; ?>
                                <p> Ratings:  <?php echo  do_shortcode( "[wppr_avg_rating]" ); ?></p>

                            </div>
                            
						</div>
                        
					</div>
                    
					<div class="clearfix"> </div>
                    <div class="plot-desc">
                        <p><span class="glb-color"> Plot: </span></p>
                        <p> <?php echo $post->post_content; ?></p>
                    </div>
                    
					<div class="all-comments">
						<div class="all-comments-info">
							<a href="#">Comments</a>
							<div class="agile-info-wthree-box">
								<?php
                                 if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                 endif;
                                ?>
							</div>
						</div>
					</div>
				</div>
                <?php if( is_active_sidebar( 'home_right_1' ) ):?>
                    <?php get_template_part('templates/content', 'sidebar'); ?>
                <?php endif; ?>
				<div class="clearfix"> </div>
			</div>
            <?php if( is_active_sidebar( 'footer-sidebar-1' ) ):?>
                <div class="w3_agile_banner_bottom_grid">
                    <?php get_template_part('templates/content', 'bottom-widgets'); ?>
                </div>
				<!-- //movie-browse-agile -->	
                <?php endif; ?>				 
			</div>
				<!-- //w3l-latest-movies-grids -->
        </div>	
    </div>
	<!-- //w3l-medile-movies-grids -->
	

<?php get_footer(); ?>