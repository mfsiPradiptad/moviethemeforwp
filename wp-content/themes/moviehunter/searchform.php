<?php 
/**
 * The template for displaying Search Results pages.
 */

?>

<form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
  <input type="text" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
  <input type="submit" value="Go">
</form>
