<?php
/**
 * Plugin Name: WP Movie Theme
 * Plugin URI: pradiptadas
 * Description: This plugin to create movie themes.
 * Version: 1.0.0
 * Author: Pradipta Das
 * Author URI: http://pradiptadas.site
 * License: GPL2
 */

define( 'PLUGINS_FILE', __FILE__ );
define( 'PLUGINS_PATH', plugin_dir_path(__FILE__) );
define( 'PLUGINS_URL', plugin_dir_url(__FILE__) );
define( 'BANNER_IMAGE_HEIGHT', 500);
define( 'BANNER_IMAGE_WIDTH', 1300);

if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-screen.php' );
    require_once( ABSPATH . 'wp-admin/includes/screen.php' );
    require_once( ABSPATH . 'wp-admin/includes/template.php' );
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

require PLUGINS_PATH . 'includes/class-movie-theme.php';
require PLUGINS_PATH . 'includes/class-movies-cpt.php';
require PLUGINS_PATH . 'includes/class-custom-meta-box.php';
require PLUGINS_PATH . 'includes/class-movies-admin-filters.php';
require PLUGINS_PATH . 'includes/class-movie-plugin-widgets.php';

new Movie_Theme();
new Movies_Custom_Post_Type();
new Custom_Meta_Box();
new Admin_Movies_Filters();
new movie_plugin_widget();
