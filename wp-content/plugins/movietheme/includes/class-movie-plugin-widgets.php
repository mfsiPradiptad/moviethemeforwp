<?php
// Creating the widget 
class movie_plugin_widget extends WP_Widget {
  
    public function __construct() {

        add_action( 'widgets_init', array ($this, 'movie_plugin_load_widget' ) );

        parent::__construct(
        
        // Base ID of your widget
        'movie_plugin_widget', 
        
        // Widget name will appear in UI
        __('Feature Movies sidebar', 'movie_plugin_widget_domain'), 
        
        // Widget description
        array( 'description' => __( 'Widget To feature movies', 'movie_plugin_widget_domain' ), ) 
        );
    }
      
    // Creating widget front-end
      
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $post_count = apply_filters( 'widget_title', $instance['post_count'] );
        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        
        // This is where you run the code and display the output
        echo __( $this->plugin_get_movies($post_count) );
        echo $args['after_widget'];
    }
              
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }  else {
            $title = __( 'New title', 'movie_plugin_widget_domain' );
        }

        if ( isset( $instance[ 'post_count' ] ) ) {
            $post_count = $instance[ 'post_count' ];
        } else {
            $post_count = __( '4', 'movie_plugin_widget_domain' );
        }
        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        <label for="<?php echo $this->get_field_id( 'post_count' ); ?>"><?php _e( 'Number:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'post_count' ); ?>" name="<?php echo $this->get_field_name( 'post_count' ); ?>" type="text" value="<?php echo esc_attr( $post_count ); ?>" />
        </p>
        <?php 
    }
            
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['post_count'] = ( ! empty( $new_instance['post_count'] ) ) ? strip_tags( $new_instance['post_count'] ) : '4';
        return $instance;
    }

    public function movie_plugin_load_widget()
    {
        register_widget( 'movie_plugin_widget' );
    }

    public function plugin_get_movies($post_count = 4)
    {
        global $wpdb;
        $result = '';
        $args = array (
            'post_type' => 'movies',
            'post_status' => 'publish',
            'posts_per_page' => $post_count,
            'meta_key' => 'sidebar_movies_hidden',
            'meta_value' => '1',
            'orderby' => 'rand',
        );
    
        $movies_query = new WP_Query( $args );
    
        if ( $movies_query->have_posts() ) {
            $result .=  '<div class="single-grid-right">';
           while( $movies_query->have_posts() ){ $movies_query->the_post();
            $post  = $movies_query->post;
            if ( has_post_thumbnail( $post->ID ) ) { 
                $url =  get_the_post_thumbnail_url($post->ID, 'movie-thumb' );
                } else {
                    $url = get_bloginfo('template_directory') . '/assets/dist/images/blanck-movie.jpg';
                }

                $result .= '<div class="single-right-grids">
                    <div class="col-md-4 single-right-grid-left">
                        <a href="' . get_post_permalink( $post->ID ) .'">
                        <img src="'. $url .'" alt="'. $post->post_title . '" />
                        </a>
                    </div>
                    <div class="col-md-8 single-right-grid-right">
                        <a href="'. get_post_permalink( $post->ID ) . '" class="title">'. $post->post_title .'</a>
                        <p class="author">Director : <span class="glb-color">'. get_post_meta($post->ID, 'movie_director', true). '</span></p>
                        
                    </div>
                    <div class="clearfix"> </div>
                </div>';
            }
            $result .= '</div>';
        }  else {
            $result = 'No Featured Sidebar Movies Found.';
        }

        return $result;
    }
     
    // Class wpb_widget ends here
}
    