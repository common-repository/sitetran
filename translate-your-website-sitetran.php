<?php
/**
 * Plugin Name:SiteTran - Translate Your WordPress Site
 * Plugin URI:https://wordpress.org/plugins/sitetran/
 * Description:WordPress Translation Made Easy. Use SiteTran to go global today!
 * Author:TranslateGreat LLC
 * Version:1.3.5
 * Tested up to:6.4.3
 * WC tested up to:6.4.3
 * Text Domain:sitetran
 * Author URI:https://www.sitetran.com/
 */


if (!defined('ABSPATH')) {
    die('-1');
}
if (!defined('SITETRAN_PLUGIN_NAME')) {
    define('SITETRAN_PLUGIN_NAME', 'SiteTran - Translate Your WordPress Site');
}
if (!defined('SITETRAN_PLUGIN_VERSION')) {
    define('SITETRAN_PLUGIN_VERSION', '1.0.0');
}
if (!defined('SITETRAN_PLUGIN_FILE')) {
    define('SITETRAN_PLUGIN_FILE', __FILE__);
}
if (!defined('SITETRAN_PLUGIN_DIR')) {
    define('SITETRAN_PLUGIN_DIR', plugins_url('', __FILE__));
}
if (!defined('SITETRAN_PLUGIN_PATH')) {
    define('SITETRAN_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
}
if (!defined('SITETRAN_DOMAIN')) {
    define('SITETRAN_DOMAIN', 'sitetran-translate');
}
if (!defined('SITETRAN_BASE_NAME_FILE')) {
    define('SITETRAN_BASE_NAME_FILE', plugin_basename(__FILE__));
}
if (!defined('SITETRAN_BASE_NAME')) {
    define('SITETRAN_BASE_NAME', plugin_basename(SITETRAN_PLUGIN_FILE));
}


if (!class_exists('SITETRAN')) {

    class SITETRAN {
        protected static $SITETRAN_instance;
        function __construct() {
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }


        function SITETRAN_load_admin_script_style() {
            wp_enqueue_style( 'SITETRAN_backend_css', SITETRAN_PLUGIN_DIR . '/css/backend_style.css', false, '1.0.0' );
            wp_enqueue_style( 'SITETRAN_tippy_light_theme_css', SITETRAN_PLUGIN_DIR . '/css/tippy_light_theme_6.3.7.css', false, '1.0.0' );
            wp_enqueue_script( 'SITETRAN_popper_js', SITETRAN_PLUGIN_DIR . '/js/popperjs_core_2.11.8.min.js', false, '1.0.0', true );
            wp_enqueue_script( 'SITETRAN_tippy_js', SITETRAN_PLUGIN_DIR . '/js/tippyjs_6.3.7.min.js', false, '1.0.0', true );
            wp_enqueue_script( 'SITETRAN_backend_js', SITETRAN_PLUGIN_DIR . '/js/backend.js', false, '1.0.0', true );
            //wp_enqueue_style('select2', SITETRAN_PLUGIN_DIR . '/css/select2.min.css' );
            //wp_enqueue_script('select2', SITETRAN_PLUGIN_DIR . '/js/select2.min.js', array('jquery') );
            //$sitetran_plugin_dir = SITETRAN_PLUGIN_DIR;
            $SITETRAN_ajax_url = admin_url( 'admin-ajax.php' );
            $SITETRAN_pages_sent = get_option('sitetran_pages_sent', 'NULL');
            $SITETRAN_intialize_success_message_seen = get_option('sitetran_intialize_success_message_seen', 'N');
            wp_localize_script( 'SITETRAN_backend_js', 'SITETRAN_js_variables', array('ajax_url' => $SITETRAN_ajax_url, 'SITETRAN_pages_sent' => $SITETRAN_pages_sent, 'SITETRAN_intialize_success_message_seen' => $SITETRAN_intialize_success_message_seen) );

            // Enqueue the Code Editor (Codemirror) for CSS Editor in plugin settings
            // We are applying codemirror scripts only if it's sitetran widget styles settings page
            if(isset($_GET["page"]) && $_GET["page"] == "sitetran-settings" && isset($_GET["tab"]) && $_GET["tab"] == "widget-styles") {
                if ( function_exists( 'wp_enqueue_code_editor' ) ) {
                    wp_enqueue_script( 'SITETRAN_initialize_codeeditor_js', SITETRAN_PLUGIN_DIR . '/js/initialize-codeeditor.js', false, '1.0.0' );
                    $sitetran_cm_settings['codeEditor'] = wp_enqueue_code_editor( array( 'type' => 'text/css' ) );
                    wp_localize_script( 'SITETRAN_initialize_codeeditor_js', 'sitetran_cm_settings', $sitetran_cm_settings );
                    wp_enqueue_script( 'wp-theme-plugin-editor' );
                    wp_enqueue_style( 'wp-codemirror' );
                }
            }
        }


        function SITETRAN_load_script_style() {
            //global $post;

            /*wp_enqueue_style( 'SITETRAN_frontend_css', SITETRAN_PLUGIN_DIR . '/css/frontend_style.css', false, '1.0.0' );
            wp_enqueue_script( 'SITETRAN_frontend_js', SITETRAN_PLUGIN_DIR . '/js/frontend.js', false, '1.0.0' );
            $SITETRAN_ajax_url = admin_url( 'admin-ajax.php' );
            $SITETRAN_plugin_dir = SITETRAN_PLUGIN_DIR;
            $SITETRAN_currency_pos = get_option( 'woocommerce_currency_pos', 'left' );
            wp_localize_script( 'SITETRAN_frontend_js', 'SITETRAN_js_variables', array('ajax_url' => $SITETRAN_ajax_url, 'currency_symbol' => $SITETRAN_currency_symbol, 'SITETRAN_currency_pos' => $SITETRAN_currency_pos, 'SITETRAN_plugin_dir' => $SITETRAN_plugin_dir) );*/


            // if custom css is inserted in plugin settings and it's not empty then apply those css
            $sitetran_widget_styles = '';
            if(get_option( 'sitetran_custom_css' ) != '') {
                $sitetran_widget_styles = wp_unslash( get_option( 'sitetran_custom_css' ) );
            }

            $sitetran_authentication_key = get_option('sitetran_authentication_key');

            // Only add the widget styles and js file if auth key was added
            if($sitetran_authentication_key != '') {
                wp_register_style( 'SITETRAN_widget_css', false );
                wp_enqueue_style( 'SITETRAN_widget_css' );
                wp_add_inline_style( 'SITETRAN_widget_css', $sitetran_widget_styles);
                wp_enqueue_script( 'SITETRAN_external_widget_js', '//c.sitetran.com/widget/v3.js', false, '3.0.0', true );
            }
        }

        function SITETRAN_settings_link($links) { 
            $settings_link = '<a href="admin.php?page=sitetran-settings">Settings</a>'; 
            $links[] = $settings_link;
            return $links; 
        }

        function init() {
            add_action( 'admin_enqueue_scripts', array($this, 'SITETRAN_load_admin_script_style'));
            add_filter("plugin_action_links_".SITETRAN_BASE_NAME_FILE, array($this, 'SITETRAN_settings_link' ) );
            add_action( 'wp_enqueue_scripts',  array($this, 'SITETRAN_load_script_style'));
        }


        function includes() {
            include_once('includes/sitetran-backend.php');
            include_once('includes/sitetran-front.php');
        }


        public static function SITETRAN_instance() {
            if (!isset(self::$SITETRAN_instance)) {
                self::$SITETRAN_instance = new self();
                self::$SITETRAN_instance->init();
                self::$SITETRAN_instance->includes();
            }
            return self::$SITETRAN_instance;
        }
    }

    
    function SITETRAN_create_db_tables() {
        global $wpdb;
        $sitetran_db_version = '1.0.0';
        $charset_collate = $wpdb->get_charset_collate();
        $sitetran_pages = $wpdb->prefix.'sitetran_pages';
        $sitetran_page_to_lang = $wpdb->prefix.'sitetran_page_to_lang';

        if($wpdb->get_var("SHOW TABLES LIKE '$sitetran_pages'") != $sitetran_pages) {

            // It would be nice to one day only use one table for data related to the pages.
            // We could add
            // `page_is_seo` varchar(1) NOT NULL,
            // `page_is_translate` varchar(1) NOT NULL,
            //
            // The reason we don't do this right now, is because we would need to add every post/page to this database, for the widget to be loaded on to it.
            // sitetran_page_id is the page_id we get from the sitetran new-page-doc api route 
            $sitetran_pages_sql = "CREATE TABLE $sitetran_pages (
                    page_id int(11) NOT NULL auto_increment,
                    post_id int(11) NOT NULL,
                    sitetran_page_id int(11),
                    page_url varchar(2000) NOT NULL,
                    translate_page varchar(1) NOT NULL,
                    seo_page varchar(1) NOT NULL,
                    PRIMARY KEY (page_id)
            ) $charset_collate;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sitetran_pages_sql );
            add_option( 'sitetran_db_version', $sitetran_db_version );
        }

        if($wpdb->get_var("SHOW TABLES LIKE '$sitetran_page_to_lang'") != $sitetran_page_to_lang) {

            $sitetran_page_to_lang_sql =  "CREATE TABLE $sitetran_page_to_lang (
                ptl_id int(11) NOT NULL auto_increment,
                page_id int(11) NOT NULL,
                language_code CHAR(12) NOT NULL,
                static_seo varchar(1) NOT NULL,
                page_body MEDIUMTEXT NOT NULL,
                PRIMARY KEY (ptl_id),
                FOREIGN KEY  (page_id) REFERENCES $sitetran_pages(page_id)
            ) $charset_collate;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sitetran_page_to_lang_sql );
            add_option( 'sitetran_db_version', $sitetran_db_version );
        }

        // On plugin activation flush the db table and insert fresh post data
        //$page_urls = SITETRAN_backend::SITETRAN_get_all_site_urls();
    }

    // PERMALINKS NEEDS TO BE INVESTIGATED. DOES THIS POTENTIALLY OVERWRITE SITE DATA?
    //Flush rewrite rules update permalinks, needs to be called when new languages are added for seo 
    function SITETRAN_update_permalinks() {
        flush_rewrite_rules(true);
    }

    function SITETRAN_deactivate() {
        delete_option( 'sitetran_db_version' );
        delete_option( 'sitetran_flush_rewrite_rules' );
        delete_option( 'sitetran_authentication_key' );
        delete_option( 'sitetran_site_id' );
        delete_option( 'sitetran_original_language_code' );
        delete_option( 'sitetran_target_languages' );
        delete_option( 'sitetran_custom_css' );
        delete_option( 'sitetran_widget_type' );
        delete_option( 'sitetran_widget_icon' );
        delete_option( 'sitetran_widget_icon_svg' );
        delete_option( 'sitetran_widget_custom_icon' );
        delete_option( 'sitetran_connect_google_analytics' );
        delete_option( 'sitetran_auto_detect_language' );
        delete_option( 'sitetran_pages_sent' );
        delete_option( 'sitetran_intialize_success_message_seen' );
        
        global $wpdb;
        $sitetran_pages = $wpdb->prefix.'sitetran_pages';
        $sitetran_page_to_lang = $wpdb->prefix.'sitetran_page_to_lang';
        $wpdb->query( "DROP TABLE IF EXISTS $sitetran_page_to_lang, $sitetran_pages" );
    }

    register_activation_hook(  SITETRAN_PLUGIN_FILE, 'SITETRAN_create_db_tables' );
    register_activation_hook( SITETRAN_PLUGIN_FILE, 'SITETRAN_update_permalinks');
    register_deactivation_hook( SITETRAN_PLUGIN_FILE, 'SITETRAN_deactivate' );
    add_action('plugins_loaded', array('SITETRAN', 'SITETRAN_instance'));

    // Register custom REST API route for updating cache.
    function SITETRAN_register_rest_api_hooks() {
        // Register a new REST route for updating cache.
        register_rest_route(
            'sitetran', '/update-cache/', array(
                'methods'  => 'POST',
                'callback' => 'SITETRAN_update_cache_callback', // The function to run when the route is hit.
                'permission_callback' => 'SITETRAN_check_api_key', // Function to check if the request has permission to proceed.
            )
        );
    }


    /**
    * Check the provided API key against the stored key.
    *
    * @return bool True if the keys match, false otherwise.
    */
    function SITETRAN_check_api_key() {
        // Get the API key from the request headers.
        $sent_key = $_SERVER['HTTP_X_API_KEY'];
        // Get the stored API key from the WordPress options table.
        $stored_key = get_option('sitetran_authentication_key');
        // Return true if the keys match, false otherwise.
        return $sent_key === $stored_key;
    }


    /**
    * Handle the incoming request to update cache.
    *
    * @param WP_REST_Request $data Data from the request.
    * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
    */
    function SITETRAN_update_cache_callback( $data ) {
        // Get the target languages from the request data.
        $target_languages = $data->get_param( 'targetLanguages' );

        // Validate the target_languages to ensure it's an array.
        if ( ! is_array( $target_languages ) ) {
            return new WP_Error( 'invalid_data', 'Invalid data provided', array( 'status' => 400 ) );
        }

        // Sanitize each language to prevent malicious data.
        foreach ( $target_languages as $key => $value ) {
            $target_languages[$key] = sanitize_text_field( $value );
        }

        $instance = new SITETRAN_backend();

        // Return a success response.
        return $instance->SITETRAN_update_all_caches($target_languages);
    }


    /**
    * Set up CORS headers for the REST API.
    *
    * @param mixed $value The response object or WP_Error object.
    * @return mixed The passed in value, unchanged.
    */
    function SITETRAN_initCors( $value ) {
        // Set the allowed origin for the CORS headers.
        // $origin_url = '*';
        $origin_url = 'https://www.sitetran.com';
    
        // Uncomment and modify the following block if you want to restrict the origin in a production environment.
        /*
        if (ENVIRONMENT === 'production') {
            $origin_url = 'https://www.sitetran.com/';
        }
        */
    
        // Set the CORS headers.
        header( 'Access-Control-Allow-Origin: ' . $origin_url );
        header( 'Access-Control-Allow-Methods: POST' );
        // header( 'Access-Control-Allow-Credentials: true' );
        header( 'Access-Control-Allow-Headers: X-API-KEY, Content-Type');
        return $value;
    }

    // Hook the function to the REST API initialization.
    add_action( 'rest_api_init', 'SITETRAN_register_rest_api_hooks');

    // Adjust the CORS headers for the REST API.
    add_action( 'rest_api_init', function() {
        // Remove the default CORS headers.
        remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
        // Add our custom CORS headers.
        add_filter( 'rest_pre_serve_request', 'SITETRAN_initCors');
    }, 15 );

}