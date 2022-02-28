<?php 
class Movies_Custom_Post_Type {

    public function __construct()
    {
        add_action( 'init', array ( $this, 'create_movie_custom_post' ) );
        // Support Featured Images
        add_theme_support( 'post-thumbnails' );

        //Generes Taxonomy
        add_action( 'init', array ( $this, 'create_genres_hierarchical_taxonomy') );

        // Add the data to the custom columns for the book post type:
        add_action( 'manage_movies_posts_custom_column' , array ( $this, 'custom_movies_column' ), 10, 2 );

        // Add the custom columns to the book post type:
        add_filter( 'manage_movies_posts_columns', array ( $this, 'set_custom_edit_movies_columns' ) );
    }

    public function create_movie_custom_post()
    {
        register_post_type( 'movies',
			array(
			'labels' => array(
            'name' => __( 'Movies' ),
            'singular_name' => __( 'Movie' ),
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'comments',
            'excerpt'
            )
        ));
    }

    public function set_custom_edit_movies_columns($columns) {
        unset( $columns['author'] );
        $columns['top_picks_movies'] = __( 'Weekly Picks', 'your_text_domain' );
        $columns['featured_movies'] = __( 'Featured Movies', 'your_text_domain' );
        $columns['sidebar_movies'] = __( 'Sidebar Movies', 'your_text_domain' );

        return $columns;
    }

    public function custom_movies_column( $column, $post_id ) {
        switch ( $column ) {

            case 'top_picks_movies' :

                $top_picks_movies = get_post_meta( $post_id , 'top_picks_movies_hidden' , true );
                $res = '<a href="javascript:void(0)" class="featured-class" data-id="' . $post_id .'" data-module="top_picks_movies" data-posts="movies"> Remove </a>';
                echo ( $top_picks_movies == 1 ) ? $res : 'N/A'; 
                break;

            case 'featured_movies' :

                $featured_movies = get_post_meta( $post_id , 'featured_movies_hidden' , true );
                $res = '<a href="javascript:void(0)" class="featured-class" data-id="' . $post_id .'" data-module="featured_movies" data-posts="movies"> Remove </a>';
                echo ( $featured_movies == 1 ) ? $res : 'N/A'; 
                break;
            
            case 'sidebar_movies' :

                $sidebar_movies = get_post_meta( $post_id , 'sidebar_movies_hidden' , true );
                $res = '<a href="javascript:void(0)" class="featured-class" data-id="' . $post_id .'" data-module="sidebar_movies" data-posts="movies"> Remove </a>';
                echo ( $sidebar_movies == 1 ) ? $res : 'N/A'; 
                break;
        }
    }
 
    public function create_genres_hierarchical_taxonomy() {
    
        // Add new taxonomy, make it hierarchical like categories
        //first do the translations part for GUI
        
        $labels = array(
            'name' => _x( 'Genres', 'taxonomy general name' ),
            'singular_name' => _x( 'Genre', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Genres' ),
            'all_items' => __( 'All Genres' ),
            'parent_item' => __( 'Parent Genre' ),
            'parent_item_colon' => __( 'Parent Genre:' ),
            'edit_item' => __( 'Edit Genre' ), 
            'update_item' => __( 'Update Genre' ),
            'add_new_item' => __( 'Add New Genre' ),
            'new_item_name' => __( 'New Genre Name' ),
            'menu_name' => __( 'Genres' ),
        );    
        
        // Now register the taxonomy
        register_taxonomy('genres',array('movies'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'genres' ),
            'show_in_nav_menus' => true,
            'has_archive' => true
        ));
    
    }

}