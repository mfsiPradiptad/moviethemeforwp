<?php
class Admin_Top_Picks_Movies extends WP_List_Table {

    public function __construct() {
        global $wpdb;

        add_action( 'admin_menu', array ( $this, 'add_top_picks_page' ) );

        //Below functions are used for ajax call
        add_action( 'wp_ajax_nopriv_add_picks_ajax', array($this,'ajax') );
        add_action( 'wp_ajax_add_picks_ajax', array($this, 'ajax') );
        
    }

    public function ajax()
    {
        $posts = isset( $_POST['posts'] ) ? $_POST['posts'] : '';        
        $status = 0;

        if( $posts != '' ) {
            $status = 11;
        }
        
        $response = array( 'status' => $status );
        echo json_encode( $response );
        die();  
        
    }

    public static function get_movies( $per_page = 5, $page_number = 1 ) {

        
        $args = array (
            'post_type' => 'movies',
            'post_status' => 'publish',
            'posts_per_page' => $per_page,
            'meta_key' => 'featured_banner_hidden',
            'meta_value' => '1'
        );

        $result = new WP_Query( $args );
        
        $data = array_map(
            function( $post ) {
                return (array) $post;
            },
            $result->posts
        );

        return $data;
    }

    public static function record_count() {


        $args = array (
            'post_type' => 'movies',
            'post_status' => 'publish',
            'meta_key' => 'featured_banner_hidden',
            'meta_value' => '1'
        );
        $result = new WP_Query( $args );

        $data = array_map(
            function( $post ) {
                return (array) $post;
            },
            $result->posts
        );

        $count = count( $data );
        
        return $count;
    }

    public function no_items() {
        _e( 'No movies avaliable.', 'sp' );
    }

    public function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="bulk-update[]" value="%s" />', $item['ID']
        );
    }

    public function column_st( $item ) {
        return '<a href="javascript:void(0);" class="featured-class" data-id="' . $item['ID'] . '" data-module="featured_banner" data-posts="movies" >Remove</a>';
    }

    public function column_pt( $item ) {
        return '<a href="' . get_edit_post_link( $item['ID'] ). '" ><b>' . $item['post_title'] . '</b></a>';
    }

    public function get_columns() {
        $columns = [
            'cb' => '<input type="checkbox" />',
            'pt' => 'Movies',
            'post_excerpt' => 'Details',
            'st' =>'Status'
        ];
        
        return $columns;
    }

    public function column_default( $item, $column_name )
    {
        switch( $column_name ) {
            case 'post_title':
            case 'post_excerpt':
                return $item[ $column_name ];

            default:
               // return print_r( $item, true ) ;
        }
    }

    public function prepare_items() {

        $this->_column_headers = $this->get_column_info();
        
        /** Process bulk action */
      //  $this->process_bulk_action();
        
        $per_page = $this->get_items_per_page( 'banners_per_page', 5 );
       // $current_page = $this->get_pagenum();
        $total_items = self::record_count();
        
        $this->set_pagination_args( [
            'total_items' => $total_items, //WE have to calculate the total number of items
            'per_page' => $per_page //WE have to determine how many items to show on a page
        ] );
        
        $this->items = self::get_movies( $per_page );
        //print_r($this->items);
    }

    public function screen_option() {

        $option = 'per_page';
        $args = [
            'label' => 'Banners',
            'default' => 5,
            'option' => 'banners_per_page'
        ];
        
        add_screen_option( $option, $args );       
    }

    public function add_top_picks_page() {
        $hook = add_menu_page( 'Top Picks Movies', 'Top Picks Movies', 'manage_options', 'top-picks-movies', array ( $this, 'top_picks_settings' ), null, 99 );
       // add_action( "load-$hook", array( $this, 'screen_option' ) );
    }

    public function top_picks_settings() {
        ?>
        <div class="wrap">
            <h2>Top Picks Movies</h2>
            <h4><button class="add-picks-btn">Add +</button></h4>
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                        <div class="meta-box-sortables ui-sortable">
                            <form method="post">
                                <?php
                                   /*  $this->prepare_items();
                                    $this->display();  */
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
                <br class="clear">
            </div>
        
        </div>
        <?php
    }

}
