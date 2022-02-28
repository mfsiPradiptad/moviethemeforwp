<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo get_bloginfo( 'name' ); ?></title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="One Movies Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <!-- //for-mobile-apps -->
    <link href="<?php echo get_bloginfo('template_directory'); ?>/assets/dist/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo get_bloginfo('template_directory'); ?>/assets/dist/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/assets/dist/css/contactstyle.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/assets/dist/css/faqstyle.css" type="text/css" media="all" />
    <link href="<?php echo get_bloginfo('template_directory'); ?>/assets/dist/css/single.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo get_bloginfo('template_directory'); ?>/assets/dist/css/medile.css" rel='stylesheet' type='text/css' />
    <!-- banner-slider -->
    <link href="<?php echo get_bloginfo('template_directory'); ?>/assets/dist/css/jquery.slidey.min.css" rel="stylesheet">
    <!-- //banner-slider -->
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/assets/dist/css/font-awesome.min.css" />
    <!-- //font-awesome icons -->
    <!-- js -->
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/assets/dist/js/jquery-2.1.4.min.js"></script>
    <!-- //js -->
    <!-- banner-bottom-plugin -->
    <link href="<?php echo get_bloginfo('template_directory'); ?>/assets/dist/css/owl.carousel.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo get_bloginfo('template_directory'); ?>/assets/dist/css/datatables.min.css" rel="stylesheet" type="text/css" media="all">

    <script src="<?php echo get_bloginfo('template_directory'); ?>/assets/dist/js/owl.carousel.js"></script>

    <!-- //banner-bottom-plugin -->
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/assets/dist/js/move-top.js"></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/assets/dist/js/easing.js"></script>
    <script src="<?php echo get_bloginfo('template_directory'); ?>/assets/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo esc_url( get_bloginfo('template_directory') . '/assets/dist/js/jquery.slidey.js' ); ?>"></script>
	<script src="<?php echo esc_url( get_bloginfo('template_directory') . '/assets/dist/js/datatables.min.js' ); ?>"></script>
	
    <script src="<?php echo esc_url( get_bloginfo('template_directory') . '/assets/dist/js/jquery.dotdotdot.min.js' ); ?>"></script>

    <!-- start-smoth-scrolling -->
</script>
    <?php wp_head();?>
</head>
	
<body>
<!-- header -->
	<div class="header">
		<div class="container">
			<div class="w3layouts_logo logo">
				<a href="<?php echo get_bloginfo( 'wpurl' );?>">
					<img src="<?php echo do_shortcode( "[get_site_logo]" ); ?>" alt="logo">
				</a>
			</div>
			<div class="w3_search">
				<?php get_search_form(); ?>
			</div>
			<div class="w3l_sign_in_register">
				<ul>
					<li><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo get_option( 'contact_email' ) != '' ? get_option( 'contact_email' ) : get_option( 'mailserver_url' );?></li>
					<?php if( get_option( 'users_can_register' ) ):?>
						<li><a href="#" data-toggle="modal" data-target="#myModal">Login</a></li>
					<?php endif; ?>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //header -->

<!-- nav -->
	<div class="movies_nav">
		<div class="container">
			<nav class="navbar navbar-default">
				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<!-- <nav> -->
						<?php 
							 wp_nav_menu( 
								array( 
									'theme_location' => 'movie-primary-menu',
									'menu_class' => 'nav navbar-nav',
									'depth' => 2,
									'container' => false,
									//Process nav menu using our custom nav walker
									'walker' => new wp_bootstrap_navwalker()
								) 
							);
						?>
					<!-- </nav> -->
				</div>
			</nav>	
		</div>
	</div>
<!-- //nav -->
