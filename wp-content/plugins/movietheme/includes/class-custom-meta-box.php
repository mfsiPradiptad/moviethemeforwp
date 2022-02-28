<?php
class Custom_Meta_Box {

    public function __construct() {
        add_action('add_meta_boxes', array ( $this, 'add_banner_image_meta_boxes' ) );
        add_action('save_post', array ( $this, 'save_banner_image_data') );
        add_action('post_edit_form_tag', array ( $this, 'update_edit_form') );
        add_action('init', array ( $this, 'add_datepicker_scripts') );
        add_action('init', array ( $this, 'add_datepicker_css') );
    
    }

    public function add_banner_image_meta_boxes() {
        // Define the custom banner for movies
        add_meta_box(
            'movies_banner_image',
            'Movies Banner',
            array ($this, 'add_movies_banner' ),
            'movies',
            'side'
        );

        add_meta_box(
            'movie_director',
            'Director',
            array ($this, 'add_movie_director' ),
            'movies',
            'side'
        );
        
        add_meta_box(
            'movie_writer',
            'Writers',
            array ($this, 'add_movie_writer' ),
            'movies',
            'side'
        );

        add_meta_box(
            'movie_year',
            'Release Year',
            array ($this, 'add_movie_year' ),
            'movies',
            'side'
        );

        add_meta_box(
            'movie_stars',
            'Stars',
            array ($this, 'add_movie_stars' ),
            'movies',
            'side'
        );

        add_meta_box(
            'featured_banners',
            'Feature Banner',
            array ($this, 'add_featured_banner' ),
            'movies',
            'side'
        );

        add_meta_box(
            'weekly_top_picks_movies',
            'Top Picks',
            array ($this, 'add_top_picks_movies' ),
            'movies',
            'side'
        );

        add_meta_box(
            'featured_picked_movies',
            'Featured Movies',
            array ($this, 'add_featured_movies' ),
            'movies',
            'side'
        );

        add_meta_box(
            'featured_sidebar_movies',
            'Featured in Sidebar',
            array ($this, 'add_sidebar_movies' ),
            'movies',
            'side'
        );
    }

    public function add_sidebar_movies()
    {
        wp_nonce_field(plugin_basename(__FILE__), 'featured_sidebar_movies_nonce');
        $html = '<p class="description">';
        $html .= 'Add to Sidebar';
        $html .= '</p>';
        $sidebar_movies = get_post_meta(get_the_ID(), 'sidebar_movies_hidden' );
        $checked = ( ! empty( $sidebar_movies ) && $sidebar_movies[0] == 1 ) ? 'checked="true"': '';
        $value = ( ! empty( $sidebar_movies ) ) ? $sidebar_movies[0] : 0;
        $html .= '<input type="checkbox" id="sidebar_movies" class="fet_checkbox" name="sidebar_movies"'.  $checked .'" />';
        $html .= '<input type="hidden" id="sidebar_movies_hidden" name="sidebar_movies_hidden" value="' . $value . '" />';
        $html .= '<label for="sidebar_movies">Sidebar Movies</label>';
       
        echo $html;
    }


    public function add_featured_movies()
    {
        wp_nonce_field(plugin_basename(__FILE__), 'featured_picked_movies_nonce');
        $html = '<p class="description">';
        $html .= 'Add to Featred movies';
        $html .= '</p>';
        $featured_movies = get_post_meta(get_the_ID(), 'featured_movies_hidden' );
        $checked = ( ! empty( $featured_movies ) && $featured_movies[0] == 1 ) ? 'checked="true"': '';
        $value = ( ! empty( $featured_movies ) ) ? $featured_movies[0] : 0;
        $html .= '<input type="checkbox" id="featured_movies" class="fet_checkbox" name="featured_movies"'.  $checked .'" />';
        $html .= '<input type="hidden" id="featured_movies_hidden" name="featured_movies_hidden" value="' . $value . '" />';
        $html .= '<label for="featured_movies">Featured Movies</label>';
       
        echo $html;
    }

    public function add_top_picks_movies()
    {
        wp_nonce_field(plugin_basename(__FILE__), 'weekly_top_picks_movies_nonce');
        $html = '<p class="description">';
        $html .= 'Add to weekly picks';
        $html .= '</p>';
        $top_picks_movies = get_post_meta(get_the_ID(), 'top_picks_movies_hidden' );
        $checked = ( ! empty( $top_picks_movies ) && $top_picks_movies[0] == 1 ) ? 'checked="true"': '';
        $value = ( ! empty( $top_picks_movies ) ) ? $top_picks_movies[0] : 0;
        $html .= '<input type="checkbox" id="top_picks_movies" class="fet_checkbox" name="top_picks_movies"'.  $checked .'" />';
        $html .= '<input type="hidden" id="top_picks_movies_hidden" name="top_picks_movies_hidden" value="' . $value . '" />';
        $html .= '<label for="top_picks_movies">Weekly Top Picks</label>';
       
        echo $html;
    }

    public function add_featured_banner()
    {
        wp_nonce_field(plugin_basename(__FILE__), 'featured_banners_nonce');
        $html = '<p class="description">';
        $html .= 'Add to Feature Banner';
        $html .= '</p>';
        $featured_banner = get_post_meta(get_the_ID(), 'featured_banner_hidden' );
        $checked = ( ! empty( $featured_banner ) && $featured_banner[0] == 1 ) ? 'checked="true"': '';
        $value = ( ! empty( $featured_banner ) ) ? $featured_banner[0] : 0;
        $html .= '<input type="checkbox" id="featured_banner" class="fet_checkbox" name="featured_banner"'.  $checked .'" />';
        $html .= '<input type="hidden" id="featured_banner_hidden" name="featured_banner_hidden" value="' . $value . '" />';
        $html .= '<label for="featured_banner">Featured Banner</label>';
       
        echo $html;
    }

    public function add_movie_director()
    {
        wp_nonce_field(plugin_basename(__FILE__), 'movie_director_nonce');
        $html = '<p class="description">';
        $html .= 'Director Of the movie.';
        $html .= '</p>';
        $director = get_post_meta(get_the_ID(), 'movie_director' );
        $director = ( ! empty( $director ) ) ? $director[0] : '';
        $html .= '<input type="text" id="movie_director" name="movie_director" value="' . $director . '" size="25" " />';
       
        echo $html;
    }

    public function add_movie_stars()
    {
        wp_nonce_field(plugin_basename(__FILE__), 'movie_stars_nonce');
        $html = '<p class="description">';
        $html .= 'Stars';
        $html .= '</p>';
        $movie_stars = get_post_meta(get_the_ID(), 'movie_stars' );
        $movie_stars = ( ! empty( $movie_stars ) ) ? $movie_stars[0] : '';
        $html .= '<input type="text" id="movie_stars" name="movie_stars" value="' . $movie_stars . '" size="25" " />';
       
        echo $html;
    }

    public function add_movie_writer()
    {
        wp_nonce_field(plugin_basename(__FILE__), 'movie_writer_nonce');
        $html = '<p class="description">';
        $html .= 'Writers Of the movie.';
        $html .= '</p>';
        $movie_writer = get_post_meta(get_the_ID(), 'movie_writer' );
        $movie_writer = ( ! empty( $movie_writer ) ) ? $movie_writer[0] : '';
        $html .= '<input type="text" id="movie_writer" name="movie_writer" value="' . $movie_writer .'" size="25" " />';
       
        echo $html;
    }

    public function add_movie_year()
    {
        wp_nonce_field(plugin_basename(__FILE__), 'movie_year_nonce');
        $html = '<p class="description">';
        $html .= 'Release Year.';
        $html .= '</p>';
        $movie_year = get_post_meta(get_the_ID(), 'movie_year' );
        $movie_year = ( ! empty( $movie_year ) ) ? $movie_year[0] : '';
        $html .= '<input type="text" class= "datepicker" name="movie_year" value="' . $movie_year .'" size="25" " />';
       
        echo $html;
    }

    public function add_movies_banner() {
 
        wp_nonce_field(plugin_basename(__FILE__), 'movies_banner_image_nonce');
         
        $html = '<p class="description">';
        $html .= 'Upload Movie Banner.(1300 x 500)';
        $html .= '</p>';
        $html .= '<input type="file" id="movies_banner_image" name="movies_banner_image" value="" size="25" accept="image/*" />';
        $banner_image = get_post_meta(get_the_ID(), 'movies_banner_image');
        
        if( ! empty( $banner_image ) ){
            $html .= '<br><img src="' . $banner_image[0]['url'] . '" title="" alt="" height="100" width="200" />';
        }
         
        echo $html;
    }

    public function save_banner_image_data($id) {
 
        if(!wp_verify_nonce($_POST['movies_banner_image_nonce'], plugin_basename(__FILE__))) {
          return $id;
        }

        if(!wp_verify_nonce($_POST['movie_director_nonce'], plugin_basename(__FILE__))) {
            return $id;
        }

        if(!wp_verify_nonce($_POST['movie_writer_nonce'], plugin_basename(__FILE__))) {
            return $id;
        }

        if(!wp_verify_nonce($_POST['movie_stars_nonce'], plugin_basename(__FILE__))) {
            return $id;
        }

        if(!wp_verify_nonce($_POST['featured_banners_nonce'], plugin_basename(__FILE__))) {
            return $id;
        }

        if(!wp_verify_nonce($_POST['weekly_top_picks_movies_nonce'], plugin_basename(__FILE__))) {
            return $id;
        }
        
        if(!wp_verify_nonce($_POST['featured_picked_movies_nonce'], plugin_basename(__FILE__))) {
            return $id;
        }

        if(!wp_verify_nonce($_POST['featured_sidebar_movies_nonce'], plugin_basename(__FILE__))) {
            return $id;
        }
           
        if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
          return $id;
        }
           
        if('movies' == $_POST['post_type']) {
          if(!current_user_can('edit_page', $id)) {
            return $id;
          }
        } else {
            if(!current_user_can('edit_page', $id)) {
                return $id;
            }
        }
 
        if( isset( $_POST['movie_director'] ) && $_POST['movie_director'] != '' ) {
            update_post_meta( $id, 'movie_director', sanitize_text_field( $_POST['movie_director'] ) );
        }

        if( isset( $_POST['movie_writer'] ) && $_POST['movie_director'] != '' ) {
            update_post_meta( $id, 'movie_writer', sanitize_text_field( $_POST['movie_writer'] ) );
        }

        if( isset( $_POST['movie_year'] ) && $_POST['movie_year'] != '' ) {
            update_post_meta( $id, 'movie_year', sanitize_text_field( $_POST['movie_year'] ) );
        }

        if( isset( $_POST['movie_stars'] ) && $_POST['movie_stars'] != '' ) {
            update_post_meta( $id, 'movie_stars', sanitize_text_field( $_POST['movie_stars'] ) );
        }
        
        if( isset( $_POST['featured_banner_hidden'] ) && $_POST['featured_banner_hidden'] != '') {
            update_post_meta( $id, 'featured_banner_hidden', $_POST['featured_banner_hidden'] );
        }
        
        if( isset( $_POST['top_picks_movies_hidden'] ) && $_POST['top_picks_movies_hidden'] != '') {
            update_post_meta( $id, 'top_picks_movies_hidden', $_POST['top_picks_movies_hidden'] );
        }
        
        if( isset( $_POST['featured_movies_hidden'] ) && $_POST['featured_movies_hidden'] != '') {
            update_post_meta( $id, 'featured_movies_hidden', $_POST['featured_movies_hidden'] );
        }

        if( isset( $_POST['sidebar_movies_hidden'] ) && $_POST['sidebar_movies_hidden'] != '') {
            update_post_meta( $id, 'sidebar_movies_hidden', $_POST['sidebar_movies_hidden'] );
        }
        
        if(!empty($_FILES['movies_banner_image']['name'])) {

            $supported_types = array('image/jpeg', 'image/png');
             
            // Get the file type of the upload
            $arr_file_type = wp_check_filetype(basename($_FILES['movies_banner_image']['name']));
            $uploaded_type = $arr_file_type['type'];
            $image_attr = getimagesize($_FILES['movies_banner_image']['tmp_name']);
            $width = $image_attr[0];
            $height = $image_attr[1];
            
            /* if( $width != BANNER_IMAGE_WIDTH || $height != BANNER_IMAGE_HEIGHT ){
                wp_die("Please upload Image the mentioned dimensions.");
            } */

            // Check if the type is supported. If not, throw an error.
            if(in_array($uploaded_type, $supported_types)) {
     
                // Use the WordPress API to upload the file
                $upload = wp_upload_bits($_FILES['movies_banner_image']['name'], null, file_get_contents($_FILES['movies_banner_image']['tmp_name']));
         
                if(isset($upload['error']) && $upload['error'] != 0) {
                    wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
                } else {
                    add_post_meta($id, 'movies_banner_image', $upload);
                    update_post_meta($id, 'movies_banner_image', $upload);     
                }
     
            } else {
                wp_die("The file type that you've uploaded is not an Image.");
            }
             
        }
         
    } // end save_custom_meta_data

    public function update_edit_form() {
        echo 'enctype="multipart/form-data"';
    } // end update_edit_form
    
    public function add_datepicker_scripts(){
        wp_enqueue_script('datepicker', PLUGINS_URL . 'assets/js/jquery-ui-1.9.2.custom.js' );
        wp_enqueue_script('datepicker-options', PLUGINS_URL . 'assets/js/custom-date-picker.js' );
    }
    public function add_datepicker_css(){
      wp_enqueue_style('datepickers', PLUGINS_URL . 'assets/css/ui-lightness/jquery-ui-1.9.2.custom.css' );
    }
}