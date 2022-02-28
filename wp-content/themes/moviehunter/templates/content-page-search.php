<?php get_header(); ?>
<div class="faq">
		<h4 class="latest-text w3_faq_latest_text w3_latest_text">Search List</h4>
			<div class="container">
				<div class="agileits-news-top">
					<ol class="breadcrumb">
					  <li><a href="<?php echo get_bloginfo('url'); ?>">Home</a></li>
					  <li><a href="#">Search</a></li>
					</ol>
				</div>
				<div class="col-md-8 bs-example bs-example-tabs " role="tabpanel" data-example-id="togglable-tabs">
						<div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
								<div class="agile-news-table">
									<table id="table-breakpoint" class="table">
										<thead>
										  <tr>
											<th>No.</th>
											<th>Movie Name</th>
											<th>Year</th>
											<th>Genre</th>
											
										  </tr>
										</thead>
										<tbody>
                                            <?php
                                                $c = 0;
                                                while ($result->have_posts()) : $result->the_post();
                                                $c++;
                                    
                                                if ( has_post_thumbnail( $post->ID ) ) { 
                                                    $url =  get_the_post_thumbnail_url($post->ID, 'movie-thumb' );
                                                } else {
                                                    $url = get_bloginfo('template_directory') . '/assets/dist/images/blanck-movie.jpg';
                                                }
                                                    $terms = get_the_terms($post, 'genres'); 
                                                    if (! empty ($terms )) :
                                                        $tax_arr = array();
                                                        foreach ( $terms as $term ) : 
                                                            $tax_arr[] = '<a class="glb-color" href="'. get_term_link($term->slug, 'genres') . '">' . $term->name . "</a>"; 
                                                        endforeach; 
                                                        $str = implode( ", ", $tax_arr );
                                                    endif;

                                                    $year = get_post_meta( $post->ID, 'movie_year' );
                                                    $year = date( "Y", strtotime( $year[0] ) );
                                                ?>
                            
                                                <tr>
                                                    <td><?php echo $c; ?></td>
                                                    <td class="w3-list-img"><a href="<?php echo the_permalink(); ?>"><img src="<?php echo $url; ?>" class="img-responsive archive-img" alt="<?php echo $post->post_title; ?>" /> <span class="glb-color"><?php echo $post->post_title; ?></span></a></td>
                                                    <td><?php echo $year; ?></td>
                                                    <td class="w3-list-info"><p><?php echo $str; ?></p></td>
                                                </tr>
                                                <?php endwhile; ?>
										</tbody>
									</table>
								</div>
							</div>
							
						</div>
				</div>
                
                <?php if( is_active_sidebar( 'home_right_2' ) ):?>
                    <?php get_template_part('templates/content', 'sidebar-archive'); ?>
                <?php endif; ?>
				<div class="clearfix"> </div>
                </div>
			</div>
	</div>
<?php 
/* while ( have_posts() ) : the_post();

endwhile; */

?>
<?php get_footer(); ?>