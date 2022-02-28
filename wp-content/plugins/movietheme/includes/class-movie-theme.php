<?php
class Movie_Theme {
    public function __construct()
    {
        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'admin_menu', array ( $this, 'social_settings_add_menu' ) );
        add_action( 'admin_enqueue_scripts', array ( $this, 'callback_for_setting_up_scripts' ) );
        
    }

    public function admin_init()
    {
        $this->social_settings_page_setup();       
    }

    public function callback_for_setting_up_scripts() {
        wp_register_style( 'namespace', PLUGINS_URL .'assets/css/style.css' );
        wp_enqueue_style( 'namespace' );

    }

    // Custom Social Settings
    public function social_settings_add_menu() {
        add_menu_page( 'Social Settings', 'Social settings', 'manage_options', 'social-settings', array ( $this, 'social_settings_page' ), null, 99 );
    }

    // Create Custom Global Settings
    public function social_settings_page() { ?>
        <div class="wrap">
            <h1>Social Settings</h1>
            <form method="post" action="options.php">
                    <?php
                            settings_fields( 'section' );
                            do_settings_sections( 'theme-options' );
                            submit_button();
                    ?>
            </form>
        </div>
    <?php 
    }

    public function social_settings_page_setup() {
        
        add_settings_section( 'section', 'All Settings', null, 'theme-options' );
        add_settings_field( 'contact_email', 'Contact Email', array ( $this, 'setting_email' ), 'theme-options', 'section' );
        add_settings_field( 'twitter', 'Twitter Page URL', array ( $this, 'setting_twitter' ), 'theme-options', 'section' );
        add_settings_field( 'instagram', 'Instagram Page URL', array ( $this, 'setting_instagram' ), 'theme-options', 'section' );
        add_settings_field( 'facebook', 'Facebook Page URL', array ( $this, 'setting_facebook' ), 'theme-options', 'section' );
        add_settings_field( 'youtube', 'Youtube Page URL', array ( $this, 'setting_youtube' ), 'theme-options', 'section' );
      
        register_setting( 'section', 'twitter' );
        register_setting( 'section', 'instagram' );
        register_setting( 'section', 'facebook' );
        register_setting( 'section', 'youtube' ); 
        register_setting( 'section', 'contact_email' ); 
      
    }

    public function setting_email() { ?>
        <input type="text" name="contact_email" class ="social-inputs" id="contact_email"  value="<?php echo get_option( 'contact_email' ); ?>" />
    <?php } 

    public function setting_twitter() { ?>
        <input type="text" name="twitter" class ="social-inputs" id="twitter" value="<?php echo get_option( 'twitter' ); ?>" />
    <?php }

     public function setting_facebook() { ?>
        <input type="text" name="facebook" class ="social-inputs" id="facebook" value="<?php echo get_option('facebook'); ?>" />
    <?php } 

    public function setting_youtube() { ?>
        <input type="text" name="youtube" class ="social-inputs" id="youtube" value="<?php echo get_option( 'youtube' ); ?>" />
    <?php } 
 
    public function setting_instagram() { ?>
        <input type="text" name="instagram" class ="social-inputs" id="instagram" value="<?php echo get_option('instagram'); ?>" />
    <?php }
}





