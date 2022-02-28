<?php
class Admin_Movies_Filters extends WP_List_Table {

    public function __construct() {
        add_action( 'admin_menu', array ( $this, 'add_banner_menu_page' ) );

        //Below functions are used for ajax call
        add_action( 'wp_ajax_nopriv_remove_ajax', array($this,'ajax') );
        add_action( 'wp_ajax_remove_ajax', array($this, 'ajax') );
        parent::__construct( array (
            'singular' => __( 'Movie' ), //singular name of the listed records
            'plural' => __( 'Movies' ), //plural name of the listed records
            'ajax' => false,
        ) );
        
    }

    public function ajax()
    {
        $id = isset( $_POST['id'] ) ? $_POST['id'] : 0;
        $module = isset( $_POST['module'] ) ? $_POST['module'] : '';
        
        $status = 0;

        if( $id > 0 && $module != '' ) {
            $field =  $module.'_hidden';
            $res = update_post_meta( $id, $field, 0 );

            if( $res > 0) {
                $status = 1;
            }
        }
        
        $response = array( 'status' => $status );
        echo json_encode( $response );
        die();  
    }

    public static function get_movies( $per_page = 5, $page_number = 1 ) {

        global $wpdb;

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
        global $wpdb;

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

    public function add_banner_menu_page() {
        $hook = add_menu_page( 'Add Movies Banner', 'Movies Banner', 'manage_options', 'movies-banner', array ( $this, 'plugin_settings_page' ), null, 99 );
        add_action( "load-$hook", array( $this, 'screen_option' ) );
    }

    public function plugin_settings_page() {
        ?>
        <div class="wrap">
            <h2>List Movies Banner</h2>
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                        <div class="meta-box-sortables ui-sortable">
                            <form method="post">
                                <?php
                                    $this->prepare_items();
                                    $this->display(); 
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
