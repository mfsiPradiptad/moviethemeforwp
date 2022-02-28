<?php get_header();?>

<!-- banner -->
	<?php get_template_part( 'templates/content', 'banner' ); ?>
<!-- //banner -->
<!-- banner-bottom -->
	<?php get_template_part( 'templates/content', 'top-picks' ); ?>
<!-- //banner-bottom -->

<!-- Social Templates -->
	<?php get_template_part( 'templates/content', 'social' ); ?>
<!-- //Social Templates -->

<!-- general -->
	<?php get_template_part( 'templates/content', 'featured-movies' ); ?>

	<?php get_template_part( 'templates/content', 'top-rated' ); ?>

	<?php get_template_part( 'templates/content', 'most-comment' ); ?>

<!-- //general -->

<?php get_footer();?>

