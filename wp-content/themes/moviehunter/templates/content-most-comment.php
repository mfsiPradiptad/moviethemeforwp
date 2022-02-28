<?php

$args = array(  
    'post_type' => 'movies',
    'post_status' => 'publish',
    'posts_per_page' => 6,
    'orderby' => 'comment_count',
    'order' => 'DESC'
);

$result = new WP_Query($args);

if ( $result->have_posts() ):
    set_query_var('result', $result);

?>
<div class="general">
		<div class="row row-mod">
			<div class="col-sm-12">
				<h4 class="latest-text w3_latest_text">Most Commented</h4> 
				
			</div>
		</div>
		<div class="container">
            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                <div id="myTabContent" class="tab-content">
                <?php
                    get_template_part('templates/content', 'movies-row'); 
                ?>
                </div>
            </div>
        </div>
	</div>
<?php
endif;