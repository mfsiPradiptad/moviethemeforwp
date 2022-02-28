<!-- footer -->
<div class="footer">
	<?php if( is_active_sidebar( 'footer-sidebar-2' ) ):
		 dynamic_sidebar( 'footer-sidebar-2' ); 
	 else:?>
		<div class="container">
			<div class="w3ls_footer_grid">
				<div class="col-md-6 w3ls_footer_grid_left">
					<div class="w3ls_footer_grid_left1">
						<h2>Subscribe to us</h2>
						<div class="w3ls_footer_grid_left1_pos">
							<form action="#" method="post">
								<input type="email" name="email" placeholder="Your email..." required="">
								<input type="submit" value="Send">
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-6 w3ls_footer_grid_right logo">
					<a href="<?php echo get_bloginfo( 'wpurl' );?>"><img src="<?php echo do_shortcode( "[get_site_logo]" ); ?>" alt="logo"></a>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="col-md-5 w3ls_footer_grid1_left">
				<p>&copy; <?php echo date('Y') . ' ' . get_bloginfo( 'name' ); ?>. All rights reserved.</a></p>
			</div>
			<div class="col-md-7 w3ls_footer_grid1_right">
			<?php 
				wp_nav_menu( 
					array( 
						'theme_location' => 'movie-secondary-menu',
					) 
				);
			?>
			</div>
			<div class="clearfix"> </div>
		</div>
	<?php endif;?>
	</div>
<!-- //footer -->
<!-- here stars scrolling icon -->

<!-- //here ends scrolling icon -->
<script type="application/x-javascript"> 
	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
	function hideURLbar(){ 
		window.scrollTo(0,1);
	} 
</script>

<?php wp_footer(); ?>
</body>
</html>