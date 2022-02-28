<?php
require_once('class-wp-bootstrap-navwalker.php');

//Site logo feature enabled
function themename_custom_logo_setup() {
    $defaults = array(
        'height'               => 100,
        'width'                => 400,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => true, 
    );
 
    add_theme_support( 'custom-logo', $defaults );
}
 
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

function display_site_logo()
{
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    $logo_path = has_custom_logo() ? $logo[0] : get_bloginfo('template_directory') . '/assets/dist/images/default-logo.jpg';

    return esc_url( $logo_path );
}

add_shortcode( 'get_site_logo', 'display_site_logo' );

function wpb_custom_new_menu() {
    register_nav_menu( 'movie-primary-menu', __( 'Primary Menu' ));
    register_nav_menu( 'movie-secondary-menu', __( 'Secondary Menu' ));

}

add_action( 'init', 'wpb_custom_new_menu' );

add_filter( 'wp_nav_menu_objects', 'mytheme_menufilter', 10, 2 );

function mytheme_menufilter($items, $args) {
    
    $menu_locations = array( 'movie-primary-menu', 'movie-secondary-menu' );

    foreach ($menu_locations as $menu) {
            $toplinks = 0;
            
            foreach ( $items as $k => $v ) {
                if ( $v->menu_item_parent == 0 ) {
                    // count how many top-level links we have so far...
                    $toplinks++;
                }
                // if we've passed our max # ...
                if ( $toplinks > 7 ) {
                    unset($items[$k]);
                }
        }
    }

    return $items;
}

function wpse_setup_theme() {
    add_theme_support( 'widgets' );
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'movie-thumb', 182, 268, true );
 }
 
 add_action( 'after_setup_theme', 'wpse_setup_theme' );

 add_action( 'wp_enqueue_scripts', 'theme_assets' );

function theme_assets() {
    wp_register_script( 'custom-js-file', get_bloginfo('template_directory') . '/assets/dist/js/custom.js', [], false, true );
    wp_enqueue_script( 'custom-js-file' );

}

function movietheme_register_sidebars() {
    register_sidebar( array(
        'name' => 'Single right sidebar',
        'id' => 'home_right_1',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="rounded">',
        'after_title' => '</h2>',
    ) );

    register_sidebar( array(
        'name' => 'Archive right sidebar',
        'id' => 'home_right_2',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="rounded">',
        'after_title' => '</h2>',
    ) );

    register_sidebar( array(
        'name' => 'Footer 1',
        'id' => 'footer-sidebar-1',
        'description' => 'Appears in the single pare',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => 'Footer 2',
        'id' => 'footer-sidebar-2',
        'description' => 'Appears in the footer area',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
add_action( 'widgets_init', 'movietheme_register_sidebars' );