<?php 
	$twitter = get_option( 'twitter' ) != '' ? get_option( 'twitter' ) : '#';
	$instagram = get_option( 'instagram' ) != '' ? get_option( 'instagram' ) : '#';
	$facebook = get_option( 'facebook' ) != '' ? get_option( 'facebook' ) : '#';
	$youtube = get_option( 'youtube' ) != '' ? get_option( 'youtube' ) : '#';

?>
<div class="general_social_icons">
	<nav class="social">
		<ul>
			<li class="w3_twitter"><a href="<?php echo $twitter; ?>" target="_blank" title="<?php echo $twitter; ?>" >Twitter <i class="fa fa-twitter"></i></a></li>
			<li class="w3_facebook"><a href="<?php echo $instagram; ?>" target="_blank" title="<?php echo $instagram; ?>" >Facebook <i class="fa fa-facebook"></i></a></li>
			<li class="w3_dribbble"><a href="<?php echo $facebook; ?>" target="_blank" title="<?php echo $facebook; ?>" >Instagram <i class="fa fa-instagram"></i></a></li>
			<li class="w3_g_plus"><a href="<?php echo $youtube; ?>" target="_blank" title="<?php echo $youtube; ?>" >YouTube<i class="fa fa-youtube-play"></i></a></li>				  
		</ul>
  </nav>
</div>