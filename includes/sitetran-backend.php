<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('SITETRAN_backend')) {

    class SITETRAN_backend {

        protected static $SITETRAN_instance;

        function SITETRAN_plugin_settings_page() {

            $sitetran_logo_svg = '<svg width="122" height="139" viewBox="0 0 122 139" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.04062 38.6979V99.9626C0.914375 101.211 1.18066 102.468 1.8024 103.558C2.42414 104.649 3.37038 105.518 4.50935 106.045L57.5419 136.58C58.5617 137.283 59.7715 137.66 61.0106 137.66C62.2497 137.66 63.4595 137.283 64.4794 136.58L117.512 106.045C118.63 105.518 119.56 104.663 120.18 103.594C120.8 102.525 121.079 101.292 120.981 100.06V38.6979C121.069 37.474 120.784 36.2522 120.165 35.1928C119.546 34.1334 118.621 33.2861 117.512 32.7619L64.5526 2.08075C63.5328 1.37694 62.323 1 61.0839 1C59.8448 1 58.635 1.37694 57.6152 2.08075L4.50935 32.7619C3.39559 33.2805 2.46668 34.1268 1.84682 35.1875C1.22696 36.2483 0.945694 37.473 1.04062 38.6979Z" fill="#DFDFDF"/>
            <path d="M1.04062 38.6979H2.04062C2.04062 38.6721 2.03962 38.6463 2.03763 38.6206L1.04062 38.6979ZM1.04062 99.9626L2.03554 100.063C2.03892 100.03 2.04062 99.9961 2.04062 99.9626H1.04062ZM4.50935 106.045L5.00832 105.178C4.98263 105.164 4.95629 105.15 4.92938 105.138L4.50935 106.045ZM57.5419 136.58L58.1099 135.757C58.0875 135.741 58.0645 135.727 58.0409 135.713L57.5419 136.58ZM64.4794 136.58L63.9804 135.713C63.9568 135.727 63.9338 135.741 63.9114 135.757L64.4794 136.58ZM117.512 106.045L117.085 105.141C117.061 105.152 117.037 105.165 117.013 105.178L117.512 106.045ZM120.981 100.06H119.981C119.981 100.087 119.982 100.113 119.984 100.14L120.981 100.06ZM120.981 38.6979L119.983 38.6262C119.981 38.65 119.981 38.674 119.981 38.6979H120.981ZM117.512 32.7619L117.011 33.6272C117.035 33.6412 117.06 33.6542 117.085 33.6661L117.512 32.7619ZM64.5526 2.08075L63.9846 2.90378C64.0063 2.91874 64.0286 2.93283 64.0513 2.94603L64.5526 2.08075ZM57.6152 2.08075L58.1154 2.94663C58.1386 2.93326 58.1612 2.91896 58.1832 2.90378L57.6152 2.08075ZM4.50935 32.7619L4.93146 33.6685C4.95809 33.6561 4.98416 33.6425 5.0096 33.6278L4.50935 32.7619ZM0.0406162 38.6979V99.9626H2.04062V38.6979H0.0406162ZM0.0456879 99.862C-0.101477 101.318 0.208946 102.783 0.933728 104.054L2.67107 103.063C2.15238 102.154 1.93023 101.105 2.03554 100.063L0.0456879 99.862ZM0.933728 104.054C1.65851 105.325 2.76157 106.338 4.08932 106.953L4.92938 105.138C3.97918 104.698 3.18977 103.973 2.67107 103.063L0.933728 104.054ZM4.01038 106.912L57.0429 137.446L58.0409 135.713L5.00832 105.178L4.01038 106.912ZM56.9739 137.403C58.1607 138.222 59.5686 138.66 61.0106 138.66V136.66C59.9744 136.66 58.9627 136.345 58.1099 135.757L56.9739 137.403ZM61.0106 138.66C62.4526 138.66 63.8605 138.222 65.0474 137.403L63.9114 135.757C63.0585 136.345 62.0468 136.66 61.0106 136.66V138.66ZM64.9783 137.446L118.011 106.912L117.013 105.178L63.9804 135.713L64.9783 137.446ZM117.938 106.95C119.24 106.336 120.323 105.34 121.045 104.095L119.315 103.092C118.797 103.986 118.019 104.7 117.085 105.141L117.938 106.95ZM121.045 104.095C121.767 102.85 122.092 101.415 121.977 99.9808L119.984 100.14C120.066 101.169 119.832 102.199 119.315 103.092L121.045 104.095ZM121.981 100.06V38.6979H119.981V100.06H121.981ZM121.978 38.7696C122.081 37.3446 121.75 35.9218 121.029 34.6883L119.302 35.6974C119.819 36.5826 120.057 37.6035 119.983 38.6262L121.978 38.7696ZM121.029 34.6883C120.308 33.4547 119.231 32.468 117.939 31.8578L117.085 33.6661C118.012 34.1041 118.785 34.8121 119.302 35.6974L121.029 34.6883ZM118.013 31.8967L65.0539 1.21547L64.0513 2.94603L117.011 33.6272L118.013 31.8967ZM65.1206 1.25772C63.9338 0.438659 62.5259 0 61.0839 0V2C62.1201 2 63.1318 2.31521 63.9846 2.90378L65.1206 1.25772ZM61.0839 0C59.6419 0 58.234 0.438658 57.0472 1.25772L58.1832 2.90378C59.036 2.31521 60.0477 2 61.0839 2V0ZM57.1149 1.21487L4.0091 31.8961L5.0096 33.6278L58.1154 2.94663L57.1149 1.21487ZM4.08724 31.8554C2.78889 32.46 1.70603 33.4464 0.983432 34.683L2.71022 35.6921C3.22734 34.8071 4.00229 34.1011 4.93146 33.6685L4.08724 31.8554ZM0.983432 34.683C0.260839 35.9195 -0.0670493 37.3472 0.0436054 38.7751L2.03763 38.6206C1.95844 37.5987 2.19309 36.577 2.71022 35.6921L0.983432 34.683Z" fill="#3E3E3F"/>
            </svg>';

            $icon = 'data:image/svg+xml;base64,' . base64_encode( $sitetran_logo_svg );


            add_menu_page( 
                __( 'SiteTran Settings', SITETRAN_DOMAIN ),
                'SiteTran',
                'manage_options',
                'sitetran-settings',
                array($this,'SITETRAN_plugin_settings_page_callback'),
                $icon
            ); 
        }

        // Here is the function to create sitetran plugin settings tabs
        function SITETRAN_plugin_admin_tabs( $current = 'authenticate' ) {

            $sitetran_authentication_key = get_option('sitetran_authentication_key');

            if($sitetran_authentication_key != '') {
                $tabs = array( 'authenticate' => 'Settings', 'pages' => 'Pages', 'widget-styles' => 'Widget Styles' );
            } else {
                $tabs = array( 'authenticate' => 'Settings' );
            }

            $links = array();
            echo '<h2 class="nav-tab-wrapper">';
            foreach( $tabs as $tab => $name ) {
                $class = ( $tab == $current ) ? ' nav-tab-active' : '';
                echo "<a class='nav-tab".esc_attr($class)."' href='?page=sitetran-settings&tab=".esc_attr($tab)."'>".esc_html($name)."</a>";
            }
            echo '</h2>';
        }

        function SITETRAN_plugin_settings_page_callback() {
            global $pagenow;


            $sitetran_authentication_key = get_option('sitetran_authentication_key');
            $sitetran_site_id = get_option('sitetran_site_id');

            if ( $sitetran_site_id != '' ) {
                $sitetran_manager_url = 'https://www.sitetran.com/site-manager-details/'.$sitetran_site_id;
            } else {
                $sitetran_manager_url = 'https://www.sitetran.com/publisher-sites/';
            }

            ?>
            
            <div class="wrap">
                <div class="sitetran-plugin-header">
                    <a href="<?php echo esc_url($sitetran_manager_url); ?>" target="_blank">
                        <img id="sitetran_wp_logo" src="<?php echo esc_url(SITETRAN_PLUGIN_DIR."/images/sitetran-logo-green.svg"); ?>" alt="<?php echo esc_attr('sitetran-logo-green'); ?>">
                    </a>
                    <?php
                    if ( $sitetran_site_id != '' ) {
                        $sitetran_manager_translate_url = 'https://www.sitetran.com/translate?site_id='.$sitetran_site_id.'&page_id=null&language_code=null';
                        ?>
                        <div class="sitetran-site-buttons">
                            <a href="<?php echo esc_url($sitetran_manager_url); ?>" class="sitetran-button-primary" target="_blank"><?php echo esc_html__( 'Edit in SiteTran', SITETRAN_DOMAIN ); ?></a>
                            <a href="<?php echo esc_url($sitetran_manager_translate_url); ?>" class="sitetran-button-secondary" target="_blank"><?php echo esc_html__( 'Translate in SiteTran', SITETRAN_DOMAIN ); ?></a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                
                <?php
                // Conditions to show message on settings saved successfully
                if ( isset($_GET['sitetran-updated']) && 'true' == $_GET['sitetran-updated'] ) {

                    if(!isset($_GET['tab']) || $_GET['tab'] == "authenticate") {
                        if($_GET['auth'] == 'success') {
                            $success_message = 'Authentication successful';
                        }
                        
                    }

                    if(isset($_GET['tab']) && $_GET['tab'] == "widget-styles") {
                        if($_GET['widget-styles-updated'] == 'success') {
                            $success_message = 'Widget styles updated';
                        }
                    }

                    if(isset($_GET['tab']) && $_GET['tab'] == "widget-styles") {
                        if($_GET['widget-styles-updated'] == 'error') {
                            if($_GET['widget-icon-upload'] == 'failed') {
                                $error_message = 'There was some error uploading custom icon';
                            }
                        }
                    }
                }

                // Conditions to show message on settings failed to save
                if ( isset($_GET['sitetran-updated']) && 'false' == $_GET['sitetran-updated'] ) {

                    if(!isset($_GET['tab']) || $_GET['tab'] == "authenticate") {

                        if($_GET['auth'] == 'invalid' || $_GET['auth'] == 'empty') {
                            $error_message = 'Authentication failed!';
                        }
                        
                    }
                }

                if ( isset ( $_GET['tab'] ) ) $this->SITETRAN_plugin_admin_tabs($_GET['tab']); else $this->SITETRAN_plugin_admin_tabs('authenticate');
                ?>

                <div id="sitetran-settings">
                    <?php
                    
                    if ( $pagenow == 'admin.php' && $_GET['page'] == 'sitetran-settings' ) { 
                    
                        if ( isset ( $_GET['tab'] ) ) $tab = sanitize_text_field($_GET['tab']); 
                        else $tab = esc_html__( 'authenticate', SITETRAN_DOMAIN );

                        switch ( $tab ) {
                            // Authenticate Tab HTML
                            case 'authenticate' :
                                ?>
                                <form method="post" id="sitetran_auth_form" action="<?php admin_url( 'admin.php?page=sitetran-settings' ); ?>">
                                    <?php wp_nonce_field( 'sitetran_auth_settings', 'sitetran_auth_settings_nounce' ); ?>
                                    <div id="sitetran-tab-default" class="sitetran-tab-content sitetran-active">
                                        <div class="sitetran_subcontainer">

                                            <?php
                                            // If Authentication successful then hide input field for key, instead of show success message otherwise form to save auth key
                                            if($sitetran_authentication_key != '') {
                                            ?>
                                            <div class="sitetran_group">
                                                <div class="sitetran_head">
                                                    <h2><?php echo esc_html__( 'Authenticate your website with SiteTran.', SITETRAN_DOMAIN ); ?></h2>
                                                </div>
                                                <div class="sitetran_group_fields">
                                                    <div class="sitetran-edit-auth-key">
                                                        <img src="<?php echo esc_url(SITETRAN_PLUGIN_DIR."/images/check-mark.png"); ?>" alt="<?php echo esc_attr('check-icon'); ?>">
                                                        <p><?php echo esc_html__( 'Successfully connected.', SITETRAN_DOMAIN ); ?></p>
                                                        <a href="#" id="sitetran-edit-auth" class="button-primary"><?php echo esc_html__( 'Edit Auth Key', SITETRAN_DOMAIN ); ?></a>
                                                    </div>
                                                    <div class="sitetran-save-auth-key">
                                                        <a href="https://www.sitetran.com/integration-guides/wordpress/authenticate-with-wordpress/" target="_blank"><?php echo esc_html__( 'How to connect?', SITETRAN_DOMAIN ); ?></a>
                                                        <input type="text" autocomplete="off" name="sitetran_authentication_key" placeholder="332-d0D55wf2fj4ioaf2WFPojwo0IJ1pqdko" value="<?php echo esc_attr(''); ?>">
                                                        <input type="hidden" name="sitetran_auth_settings_action" value="<?php echo esc_attr('Y'); ?>">
                                                        <input type="submit" value="<?php echo esc_html__( 'Save', SITETRAN_DOMAIN ); ?>" name="submit" class="button-primary" id="sitetran_auth_form_submit">
                                                        <a href="#" id="sitetran-edit-auth-cancel" class="button-primary"><?php echo esc_html__( 'Cancel', SITETRAN_DOMAIN ); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sitetran_auth_tab_other_settings">
                                                <div class="sitetran_group">
                                                    <div class="sitetran_head">
                                                        <h2><?php echo esc_html__( 'Google Analytics', SITETRAN_DOMAIN ); ?></h2>
                                                    </div>
                                                    <div class="sitetran_group_fields">
                                                        <?php
                                                            $sitetran_connect_google_analytics = get_option( 'sitetran_connect_google_analytics', 'N' );
                                                        ?>
                                                        <div class="sitetran-google-analytics">
                                                            <input type="checkbox" id="sitetran_connect_google_analytics" name="sitetran_connect_google_analytics" value="<?php echo esc_attr('Y'); ?>" <?php if($sitetran_connect_google_analytics == "Y") { echo esc_html("checked"); } ?>>
                                                            <label for="sitetran_connect_google_analytics"><?php echo esc_html__( 'Connect with Google Analytics', SITETRAN_DOMAIN ); ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="sitetran_group">
                                                    <div class="sitetran_head">
                                                        <h2><?php echo esc_html__( 'Auto Detect Language', SITETRAN_DOMAIN ); ?></h2>
                                                    </div>
                                                    <div class="sitetran_group_fields">
                                                        <?php
                                                            $sitetran_auto_detect_language = get_option( 'sitetran_auto_detect_language', 'Y' );
                                                        ?>
                                                        <div class="sitetran-google-analytics">
                                                            <input type="checkbox" id="sitetran_auto_detect_language" name="sitetran_auto_detect_language" value="<?php echo esc_attr('Y'); ?>" <?php if($sitetran_auto_detect_language == "Y") { echo esc_html("checked"); } ?>>
                                                            <label for="sitetran_auto_detect_language"><?php echo esc_html__( "Auto detect language from user's browser", SITETRAN_DOMAIN ); ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            } else {
                                            ?>
                                            <div class="sitetran_group">
                                                <div class="sitetran_head">
                                                    <h2><?php echo esc_html__( 'Authenticate your website with SiteTran.', SITETRAN_DOMAIN ); ?></h2>
                                                </div>
                                                <div class="sitetran_group_fields">
                                                    <div class="sitetran-save-auth-key sitetran-save-auth-key-show">
                                                        <a href="<?php echo esc_url('https://www.sitetran.com/integration-guides/wordpress/authenticate-with-wordpress/'); ?>" target="_blank"><?php echo esc_html__( 'How to connect?', SITETRAN_DOMAIN ); ?></a>
                                                        <input type="text" autocomplete="off" name="sitetran_authentication_key" placeholder="332-d0D55wf2fj4ioaf2WFPojwo0IJ1pqdko" value="<?php echo esc_attr(''); ?>">
                                                        <input type="hidden" name="sitetran_auth_settings_action" value="<?php echo esc_attr('Y'); ?>">
                                                        <input type="submit" value="<?php echo esc_html__( 'Save', SITETRAN_DOMAIN ); ?>" name="submit" class="button-primary" id="sitetran_auth_form_submit">
                                                        <?php
                                                        if(isset($_REQUEST['auth']) && $_REQUEST['auth'] == 'empty') {
                                                            echo '<p class="description">'.esc_html__( 'Please enter valid authentication key.', SITETRAN_DOMAIN ).'</p>';
                                                        }
                                                        if(isset($_REQUEST['auth']) && $_REQUEST['auth'] == 'invalid') {
                                                            echo '<p class="description">'.esc_html__( 'Please check your key. If it continues to fail, generate a new key on', SITETRAN_DOMAIN ).' <a href=" ' . esc_url("https://www.sitetran.com/") . ' " target="_blank">'.esc_html__( 'sitetran.com', SITETRAN_DOMAIN ).'</a></p>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    
                                </form>
                                <?php
                            break; 

                            // Pages Tab HTML
                            case 'pages' : 
                                ?>
                                <!-- If Authentication successful then only show Update Cache Button and Table for Seo and Translate -->
                                <?php if($sitetran_authentication_key != '') { ?>
                                
                                <div class="sitetran_subcontainer">
                                    <div class="sitetran_group">
                                        <?php 
                                        $Sitetran_All_Urls_List_Table = new Sitetran_All_Urls_List_Table();
                                        $Sitetran_All_Urls_List_Table->prepare_items();
                                        ?>
                                        <div class="sitetran_head">
                                            <h2>All Urls List</h2>
                                        </div>
                                        <?php $Sitetran_All_Urls_List_Table->display(); ?>
                                        <!-- <form method="post" class="sitetran_update_caches">
                                            
                                            <input type="hidden" name="action" value="sitetran_update_cache_action">
                                            <input type="submit" value="Update Caches" name="submit" class="button-primary">
                                        </form> -->
                                    </div>
                                </div>
                                <button class="button-primary sitetran_update_caches"><?php echo esc_html__( 'Update All', SITETRAN_DOMAIN ); ?></button>
                                <?php 
                                }
                            break;

                            // Widget Styles Tab HTML
                            case 'widget-styles' : 
                                ?>
                                <!-- If Authentication successful then only show Widget Styles Option -->
                                <?php if($sitetran_authentication_key != '') { ?>
                                <form method="post" enctype="multipart/form-data" action="<?php admin_url( 'admin.php?page=sitetran-settings' ); ?>">
                                    <div class="sitetran_subcontainer">
                                        <div class="sitetran_group">
                                            <div class="sitetran_head">
                                                <h2><?php echo esc_html__( 'Widget CSS', SITETRAN_DOMAIN ); ?></h2>
                                            </div>
                                            <div class="sitetran_group_fields">
                                                <div class="sitetran-custom-css">
                                                    <?php wp_nonce_field( 'sitetran_widget_styles', 'sitetran_widget_styles_nounce' ); ?>
                                                    <textarea name="sitetran_custom_css" id="sitetran_custom_css" rows="10" cols="70"><?php echo wp_kses_post( wp_unslash( get_option( 'sitetran_custom_css' ) ) ); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="sitetran_group">
                                            <div class="sitetran_head">
                                                <h2>Widget Type</h2>
                                            </div>
                                            <div class="sitetran_group_fields">
                                                <?php
                                                // $sitetran_widget_type = get_option( 'sitetran_widget_type', 'styled-select' );
                                                ?>
                                                <div class="sitetran-widget-type">
                                                <input type="radio" name="sitetran_widget_type" value="styled-select" <?php // if($sitetran_widget_type == "styled-select") { echo "checked"; } ?>>Select Box
                                                <input type="radio" name="sitetran_widget_type" value="list" <?php // if($sitetran_widget_type == "list") { echo "checked"; } ?>>Dropdown List
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="sitetran_group">
                                            <div class="sitetran_head">
                                                <h2><?php echo esc_html__( 'Widget Icon', SITETRAN_DOMAIN ); ?></h2>
                                            </div>
                                            <div class="sitetran_group_fields">
                                                <?php
                                                $sitetran_widget_icon = get_option( 'sitetran_widget_icon', 'use_icon' );
                                                ?>
                                                <div class="sitetran-widget-icon">
                                                <input type="radio" id="sitetran_use_icon" name="sitetran_widget_icon" value="<?php echo esc_attr('use_icon'); ?>" <?php if($sitetran_widget_icon == "use_icon") { echo esc_html("checked"); } ?>><label for="sitetran_use_icon"><?php echo esc_html__( 'Use Icon', SITETRAN_DOMAIN ); ?></label>
                                                <input type="radio" id="sitetran_no_icon" name="sitetran_widget_icon" value="<?php echo esc_attr('no_icon'); ?>" <?php if($sitetran_widget_icon == "no_icon") { echo esc_html("checked"); } ?>><label for="sitetran_use_icon"><?php echo esc_html__( 'No Icon', SITETRAN_DOMAIN ); ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="sitetran_widget_icon_main" style="<?php echo esc_attr( 'use_icon' === $sitetran_widget_icon ? 'display: block;' : 'display: none;' ); ?>">
                                            <div class="sitetran_group">
                                                <div class="sitetran_group_fields_icon">
                                                    <span class="sitetran_group_fields_icon_label"><?php echo esc_html__( 'Icon:', SITETRAN_DOMAIN ); ?></span>
                                                    <div class="sitetran_group_fields_icon_selector">
                                                        <?php
                                                        $sitetran_widget_icon_svg = get_option( 'sitetran_widget_icon_svg', 'new-st-box.svg' );
                                                        ?>
                                                        <input id="sitetran_widget_icon_svg_1" type="radio" name="sitetran_widget_icon_svg" value="<?php echo esc_attr('new-st-box.svg'); ?>" <?php if($sitetran_widget_icon_svg == "new-st-box.svg") { echo esc_html("checked"); } ?>/>
                                                        <label class="sitetran_icon_label" for="sitetran_widget_icon_svg_1">
                                                            <img src="<?php echo esc_url(SITETRAN_PLUGIN_DIR."/images/widget-icons/new-st-box.svg"); ?>" alt="<?php echo esc_attr('new-st-box.svg'); ?>" />
                                                        </label>
                                                        <input id="sitetran_widget_icon_svg_2" type="radio" name="sitetran_widget_icon_svg" value="<?php echo esc_attr('sitetran-globe.svg'); ?>" <?php if($sitetran_widget_icon_svg == "sitetran-globe.svg") { echo esc_html("checked"); } ?>/>
                                                        <label class="sitetran_icon_label" for="sitetran_widget_icon_svg_2">
                                                            <img src="<?php echo esc_url(SITETRAN_PLUGIN_DIR."/images/widget-icons/sitetran-globe.svg"); ?>" alt="<?php echo esc_attr('sitetran-globe.svg'); ?>" />
                                                        </label>
                                                        <input id="sitetran_widget_icon_svg_3" type="radio" name="sitetran_widget_icon_svg" value="<?php echo esc_attr('black-lang-display.svg'); ?>" <?php if($sitetran_widget_icon_svg == "black-lang-display.svg") { echo esc_html("checked"); } ?>/>
                                                        <label class="sitetran_icon_label" for="sitetran_widget_icon_svg_3">
                                                            <img src="<?php echo esc_url(SITETRAN_PLUGIN_DIR."/images/widget-icons/black-lang-display.svg"); ?>" alt="<?php echo esc_attr('black-lang-display.svg'); ?>" />    
                                                        </label>
                                                        <?php
                                                        $sitetran_widget_custom_icon = get_option( 'sitetran_widget_custom_icon' );
                                                        if(isset($sitetran_widget_custom_icon) && $sitetran_widget_custom_icon != '') {
                                                        ?>
                                                        <input id="sitetran_widget_icon_svg_4" type="radio" name="sitetran_widget_icon_svg" value="<?php echo esc_attr( $sitetran_widget_custom_icon ); ?>" <?php if($sitetran_widget_icon_svg == $sitetran_widget_custom_icon) { echo "checked"; } ?>/>
                                                        <label class="sitetran_icon_label" for="sitetran_widget_icon_svg_4">
                                                            <img src="<?php echo esc_url(SITETRAN_PLUGIN_DIR."/images/widget-icons/".$sitetran_widget_custom_icon); ?>" alt="<?php echo esc_attr( $sitetran_widget_custom_icon ); ?>" />    
                                                        </label>
                                                        <?php 
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="sitetran_group">
                                                <div class="sitetran_group_fields_custom_icon">
                                                    <span class="sitetran_group_fields_custom_image_label"><?php echo esc_html__( 'Or choose your own image:', SITETRAN_DOMAIN ); ?></span>
                                                    <input type="file" name="sitetran_widget_custom_icon" accept="image/x-png, image/svg+xml" />
                                                    <span class="description"><strong><?php echo esc_html__( 'Only png and svg filetypes allowed', SITETRAN_DOMAIN ); ?></strong></span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="sitetran_group">
                                            <div class="sitetran_group_fields">
                                                <input type="hidden" name="action" value="sitetran_widget_styles_action">
                                                <input type="submit" value="<?php echo esc_html__( 'Save', SITETRAN_DOMAIN ); ?>" name="submit" class="button-primary">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php 
                                }
                            break;
                        }
                    }
                    ?>

                </div>
                <?php
                $success_is_hidden = 'sitetran-is-hidden';
                $error_is_hidden = 'sitetran-is-hidden';

                if ( isset($success_message) && !empty($success_message) ) {
                    $success_is_hidden = '';
                }

                if ( isset($error_message) && !empty($error_message) ) {
                    $error_is_hidden = '';
                }

                ?>
                <!-- HTML to show success/error message dialog box starts -->
                <div class="sitetran-messages-container">
                    <div class="sitetran-success-message <?php echo $success_is_hidden; ?>">
                        <span class="sitetran-success-message-text"><?php echo esc_html__( $success_message, SITETRAN_DOMAIN ); ?></span>
                        <span class="sitetran-close-btn">&times;</span>
                    </div>
                    <div class="sitetran-error-message <?php echo $error_is_hidden; ?>">
                        <span class="sitetran-error-message-text"><?php echo esc_html__( $error_message, SITETRAN_DOMAIN ); ?></span>
                        <span class="sitetran-close-btn">&times;</span>
                    </div>
                    <div class="sitetran-loader sitetran-is-hidden">
                        <div class="sitetran-loading-circle"></div>
                        <span class="sitetran-loader-message-text"><?php echo esc_html__( 'Loading...', SITETRAN_DOMAIN ); ?></span>
                    </div>
                </div>
                <!-- HTML to show success/error message dialog box ends -->
            </div>

           <?php
        }


        // getting array of all page/post urls, skipped taxonomy urls (categories, tags, product-categories)
        // permalinks settings -> wp-admin/options-permalink.php
        //Call this to retrieve all site urls
        public static function SITETRAN_get_all_site_urls() {
            $page_urls = array();

            // If "Your latest posts" is set as your homepage then we are getting one homepage link
            // If some page is set as homepage then we are getting two homepage links
            // So we need do some condition to get only one homepage link in any of above case
            // Here we add the homepage url and we make sure not to add it to the page_urls array anywhere else
            $page_data_home['post_id'] = get_option('page_on_front');
            $page_data_home['page_url'] = get_site_url().'/'; // site_url() also works
            $page_urls[] = $page_data_home;

            $posts = new WP_Query('post_type=any&posts_per_page=-1&post_status=publish');
            
            $posts = $posts->posts;
            foreach($posts as $post) {
                switch ($post->post_type) {
                    case 'revision':
                    case 'nav_menu_item':
                    case 'wp_global_styles':
                        break;
                    case 'page':
                        $permalink = get_page_link($post->ID);
                        break;
                    case 'post':
                        $permalink = get_permalink($post->ID);
                        break;
                    case 'attachment': // IF POST TYPE IS ATTACHMENT THEN WE SHOULD NOT ADD IT IN DB
                        $permalink = get_attachment_link($post->ID);
                        break;
                    default:
                        $permalink = get_post_permalink($post->ID);
                        break;
                }
                $page_data['post_id'] = $post->ID;
                //$page_data['url'] = $permalink;
                
                $frontpage_id = get_option( 'page_on_front' );

                // We are checking if it's homepage, if yes we don't add to page_urls array
                // We already added homepage to page_urls above
                if($post->ID != $frontpage_id) {
                    $page_data['page_url'] = $permalink;
                    $page_urls[] = $page_data;
                }
            }

            return $page_urls;
        }


        // function will be called on init - used for saving plugin settings, add/update cache translations
        function SITETRAN_plugin_save_settings() {
            if( current_user_can('administrator') ) {
                global $wpdb;
                $sitetran_pages = $wpdb->prefix.'sitetran_pages';
                $sitetran_page_to_lang = $wpdb->prefix.'sitetran_page_to_lang';

                ob_start();
                ?>
#sitetran_translate_element select { 
    width: auto;
    margin: 0;
    color: #787878;
    font-size: 15px;
    padding: 5px 8px;
    border: none;
    background: none;
    -moz-appearance: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    -webkit-appearance: none;
    appearance: none;
    cursor: pointer;
    padding-right: 24px;
}
    
#sitetran_translate_element select:focus {
    outline: none;
}
    
#sitetran_translate_element::after {
    content: '';
    background: url("<?php echo esc_url('https://c.sitetran.com/down-caret.svg'); ?>") no-repeat 90% 50%;
    height: 10px;
    width: 10px;
    display: block;
    z-index: 4;
    pointer-events: none;
    position: absolute;
    top: 52%;
    transform: translateY(-50%);
    right: 8px;
}
    
body[dir="RTL"] #sitetran_translate_element select {
    padding-right: 8px;
    padding-left: 24px;
}
    
body[dir="RTL"] #sitetran_translate_element::after {
    right: auto;
    left: 10px;
}

#sitetran_translate_element:hover { 
    background-color: #f1f3f4;
}

#sitetran_translate_element { 
    background-color: white;
    position: relative;
    border: 1px solid #A6A6A6;
    box-shadow: 1px 1px 3px 0 rgba(93, 93, 93, 0.1);
    overflow: hidden;
    border-radius: 5px;
}

#sitetran_toggle { 
    margin-right: 9px;
    margin-left: 9px;
}

#sitetran_translate_wrapper {
    display: flex;
    align-items: center;
    z-index: 2147483647;
}

.sitetran-default-widget {
	position: fixed;
	right: 1em;
	bottom: 1em;
}
<?php
                $sitetran_custom_css = ob_get_clean();

                // This is the condition to execute when use click on Authenticate Button
                // Here we checking auth and then saving auth key, site id, source language and translation languages and also populating the db table wp_sitetran_pages
                if(isset($_REQUEST['sitetran_auth_settings_action']) && $_REQUEST['sitetran_auth_settings_action'] == 'Y') {

                    if(!isset( $_POST['sitetran_auth_settings_nounce'] ) || !wp_verify_nonce( $_POST['sitetran_auth_settings_nounce'], 'sitetran_auth_settings' ) ) {

                        echo 'Sorry, your nonce did not verify.';
                        exit;
                    } else {
                        // We are deleting auth key, site id, languages on form submit
                        delete_option( 'sitetran_authentication_key' );
                        delete_option( 'sitetran_site_id' );
                        delete_option( 'sitetran_original_language_code' );
                        delete_option( 'sitetran_target_languages' );

                        // If sitetran_authentication_key is not empty then validate and insert data else show invalid auth key message
                        if(isset($_REQUEST['sitetran_authentication_key']) && $_REQUEST['sitetran_authentication_key'] != '') {

                            $sitetran_authentication_key = sanitize_text_field( $_REQUEST['sitetran_authentication_key'] );


                            // User submits AUTH key, we use it to get the site_id, original_lang, to_languages - we store it in wp_options for now
                            // If the sitetran table is empty, we populate without sitetran_page_body
                            $apiUrl = 'https://www.sitetran.com/api/sitetran-wordpress-get-site-and-langs?auth_key='.$sitetran_authentication_key;

                            // add home url to request
                            $home_url = rtrim( get_home_url(), '/' );
                            $home_domain = parse_url( $home_url, PHP_URL_HOST );

                            $apiUrl = $apiUrl . '&domain_name=' . $home_domain;

                            // getting response from api
                            $response = wp_remote_request( esc_url_raw( $apiUrl ),
                                array(
                                    'method'     => 'GET'
                                )
                            );

                            if( is_wp_error( $response ) ) {
                                $body = esc_html__('There was an error');
                                return $body;
                            }

                            $api_response = wp_remote_retrieve_body($response);
                            $site_data = json_decode($api_response);
                            //$aaa = '"'.$api_response.'"';
                            //print_r($api_response);
                            //exit;
                            if($response['response']['code'] == '403') {
                                $url_parameters = isset($_GET['tab'])? 'sitetran-updated=false&tab='.sanitize_text_field($_GET['tab']).'&auth=invalid' : 'sitetran-updated=false&auth=invalid';
                                wp_redirect(admin_url('admin.php?page=sitetran-settings&'.$url_parameters));
                                exit;
                            } else {

                                // We are saving auth key, site id, languages on valid response and auth is successful
                                update_option('sitetran_authentication_key', $sitetran_authentication_key, 'yes');
                                update_option('sitetran_site_id', sanitize_text_field( $site_data->site_id ), 'yes');
                                update_option('sitetran_original_language_code', sanitize_text_field( $site_data->source_language ), 'yes');
                                update_option('sitetran_target_languages', json_encode($site_data->target_languages), 'yes');

                                // We are saving default css for widget
                                update_option('sitetran_custom_css', $sitetran_custom_css, 'yes');

                                $url_parameters = isset($_GET['tab'])? 'sitetran-updated=true&tab='.sanitize_text_field($_GET['tab']).'&auth=success' : 'sitetran-updated=true&auth=success';
                                wp_redirect(admin_url('admin.php?page=sitetran-settings&'.$url_parameters));
                                exit;
                            }
                        } else {
                            $url_parameters = isset($_GET['tab'])? 'sitetran-updated=false&tab='.sanitize_text_field($_GET['tab']).'&auth=empty' : 'sitetran-updated=false&auth=empty';
                            wp_redirect(admin_url('admin.php?page=sitetran-settings&'.$url_parameters));
                            exit;
                        }
                    }
                }


                // Saving Widget Styles
                if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'sitetran_widget_styles_action') {
                    if(!isset( $_POST['sitetran_widget_styles_nounce'] ) || !wp_verify_nonce( $_POST['sitetran_widget_styles_nounce'], 'sitetran_widget_styles' ) ) {

                        echo 'Sorry, your nonce did not verify.';
                        exit;
                    } else {

                        // We are saving widget styles
                        $sitetran_custom_css = sanitize_textarea_field($_POST['sitetran_custom_css']);
                        update_option('sitetran_custom_css', $sitetran_custom_css, 'yes');

                        // $sitetran_widget_type = sanitize_text_field($_POST['sitetran_widget_type']);
                        // update_option('sitetran_widget_type', $sitetran_widget_type, 'yes');

                        $sitetran_widget_icon = sanitize_text_field($_POST['sitetran_widget_icon']);
                        update_option('sitetran_widget_icon', $sitetran_widget_icon, 'yes');

                        $sitetran_widget_icon_svg = sanitize_text_field($_POST['sitetran_widget_icon_svg']);
                        update_option('sitetran_widget_icon_svg', $sitetran_widget_icon_svg, 'yes');

                        // Uploading custom icon
                        $target_dir_location = SITETRAN_PLUGIN_PATH . 'images/widget-icons/';

                        if(isset($_FILES['sitetran_widget_custom_icon']) && $_FILES['sitetran_widget_custom_icon']['name'] != "") {
                            $name_file = $_FILES['sitetran_widget_custom_icon']['name'];
                            $tmp_name = $_FILES['sitetran_widget_custom_icon']['tmp_name'];
                        
                            if( move_uploaded_file( $tmp_name, $target_dir_location.$name_file ) ) {
                                update_option('sitetran_widget_icon_svg', $name_file, 'yes');
                                update_option('sitetran_widget_custom_icon', $name_file, 'yes');
                            } else {
                                $url_parameters = isset($_GET['tab']) ? 'sitetran-updated=true&widget-styles-updated=error&widget-icon-upload=failed&tab='.sanitize_text_field($_GET['tab']) : 'sitetran-updated=true&widget-styles-updated=error&widget-icon-upload=failed';
                                wp_redirect(admin_url('admin.php?page=sitetran-settings&'.$url_parameters));
                                exit;
                            }
                        
                        }

                        $url_parameters = isset($_GET['tab']) ? 'sitetran-updated=true&widget-styles-updated=success&tab='.sanitize_text_field($_GET['tab']) : 'sitetran-updated=true&widget-styles-updated=success';
                        wp_redirect(admin_url('admin.php?page=sitetran-settings&'.$url_parameters));
                        exit;
                    }
                }
            }
        }


        // ajax callback when "Translate" checkbox is clicked on all urls list
        function SITETRAN_dnt_ajax_callback() {
            global $wpdb;
            $tablename=$wpdb->prefix.'sitetran_pages';
            $stPageID = sanitize_text_field( $_REQUEST['stPageID'] );
            $sitetranTranslate = sanitize_text_field( $_REQUEST['sitetranTranslate'] );
            
            $data = array(
                'translate_page'  => $sitetranTranslate,
            );

            $condition = array(
                'page_id' => $stPageID,
            );

            // If setting saved successfully then send success message
            if ($wpdb->update($tablename, $data, $condition)) {
                $ajax_message = esc_html__("Updated page's translation settings");
                $ajax_response = array('status'=>'success', 'message' => $ajax_message);
                echo json_encode($ajax_response);
                exit;
            } else {
                $ajax_message = esc_html__("Failed to update page's translation settings");
                $ajax_response = array('status'=>'error', 'message' => $ajax_message);
                echo json_encode($ajax_response);
            }
            exit;
        }

        // ajax callback when "Use SEO" checkbox is clicked on all urls list
        function SITETRAN_dns_ajax_callback() {
            global $wpdb;
            $tablename=$wpdb->prefix.'sitetran_pages';
            $stPageID = sanitize_text_field( $_REQUEST['stPageID'] );
            $stPageUrl = sanitize_text_field( $_REQUEST['stPageUrl'] );
            $sitetranSEO = sanitize_text_field( $_REQUEST['sitetranSEO'] );

            $data = array(
                'seo_page'  => $sitetranSEO,
            );

            $condition = array(
                'page_id' => $stPageID,
            );

            // If setting saved successfully then update cache and send success message
            if ($wpdb->update($tablename, $data, $condition)) {
                if ($sitetranSEO == 'Y') {
                    // function is called to save/update cache for url
                    if ($this->SITETRAN_update_page_cache($stPageID, $stPageUrl)) {
                        $ajax_message = esc_html__("Successfully updated the page's cache");
                        $ajax_response = array('status'=>'success', 'message' => $ajax_message);
                        echo json_encode($ajax_response);
                    } else {
                        $ajax_message = esc_html__("Request failed: Generate a new API key in SiteTran");
                        $ajax_response = array('status'=>'error', 'message' => $ajax_message);
                        echo json_encode($ajax_response);
                    }
                } else {
                    $ajax_message = esc_html__("Successfully updated the page's SEO settings");
                    $ajax_response = array('status'=>'success', 'message' => $ajax_message);
                    echo json_encode($ajax_response);
                }
                
                exit;
            } else {
                $ajax_message = esc_html__("Error code 133. Contact us.");
                $ajax_response = array('status'=>'error', 'message' => $ajax_message);
                echo json_encode($ajax_response);
                exit;
            }

            exit;
        }

        // ajax callback when "Update Cache" button is clicked on all urls list
        function SITETRAN_upseo_ajax_callback() {
            $stPageID = sanitize_text_field( $_REQUEST['stPageID'] );
            $stPageUrl = sanitize_text_field( $_REQUEST['stPageUrl'] );

            // function is called to save/update cache for url
            if ($this->SITETRAN_update_page_cache($stPageID, $stPageUrl)) {
                $ajax_message = esc_html__("Successfully updated the page's cache");
                $ajax_response = array('status'=>'success', 'message' => $ajax_message);
                echo json_encode($ajax_response);
            } else {
                $ajax_message = esc_html__("Request failed: Generate a new API key in SiteTran");
                $ajax_response = array('status'=>'error', 'message' => $ajax_message);
                echo json_encode($ajax_response);
            }
            exit;
        }

        // ajax callback when "Update Caches" button is clicked
        function SITETRAN_update_caches_callback() {

            // function is called to save/update caches
            if ($this->SITETRAN_update_all_caches()) {
                $ajax_message = esc_html__("Updated page caches");
                $ajax_response = array('status'=>'success', 'message' => $ajax_message);
                echo json_encode($ajax_response);
            } else {
                $ajax_message = esc_html__("Failed to Update page caches");
                $ajax_response = array('status'=>'error', 'message' => $ajax_message);
                echo json_encode($ajax_response);
            }
            exit;
        }

        // We are inserting urls to sitetran_pages db table when admin creates new posts/pages
        // We ALSO use this to generate page-docs for new/edited posts
        function SITETRAN_save_url_to_db_on_new_post_publish($new_status, $old_status, $post) {
            global $wpdb;
            $sitetran_pages = $wpdb->prefix.'sitetran_pages';
            $sitetran_authentication_key = get_option('sitetran_authentication_key');

            // We are not adding urls which has post type = nav_menu_item
            // WE ALSO NEED TO SKIP MORE POST TYPES WHICH DO NOT CREATE FRONT PAGES
            // SOME PLUGINS CREATES POSTS
            if ( 'nav_menu_item' == $post->post_type ) {
                return;
            }

            if ( 'publish' !== $new_status ) {
                return;
            }

            if ( 'publish' == $old_status ) {

                $data = array(
                    'page_url' => get_permalink($post->ID),
                );

                $condition = array(
                    'post_id' => $post->ID,
                );
    
                $wpdb->update( $sitetran_pages, $data, $condition);
                $this->SITETRAN_generate_page_doc($post->ID, $sitetran_authentication_key, false);
            } else {
                $data = array(
                    'post_id'                   => $post->ID,
                    'page_url'                  => get_permalink($post->ID),
                    'translate_page'            => 'Y',
                    'seo_page'                  => 'N',
                );
    
                $wpdb->insert( $sitetran_pages, $data);
                $this->SITETRAN_generate_page_doc($post->ID, $sitetran_authentication_key, true);
            }
        }


        // Update Languages in wp_options db table
        // CONSIDER USING THIS FUNCTION ALSO WHEN AUTHENTICATING AND GETTING LANGUAGES
        function SITETRAN_get_languages($sitetran_authentication_key) {

            // User submits AUTH key, we use it to get the site_id, original_lang, to_languages - we store it in wp_options for now
            // If the sitetran table is empty, we populate without sitetran_page_body

            $apiUrl = 'https://www.sitetran.com/api/sitetran-wordpress-get-site-and-langs?auth_key='.$sitetran_authentication_key;

            // getting response from api
            $response = wp_remote_request( esc_url_raw( $apiUrl ),
                array(
                    'method'     => 'GET'
                )
            );

            if( is_wp_error( $response ) ) {
                $body = esc_html__('There was an error');
                return $body;
            }

            $api_response = wp_remote_retrieve_body($response);
            $site_data = json_decode($api_response);
            
            if( $response['response']['code'] == '403' ) {
                delete_option('sitetran_target_languages');
            } else {
                // CHECK IF DATA IS OUT OF DATE AND NEEDS TO BE UPDATED
                update_option('sitetran_original_language_code', sanitize_text_field( $site_data->source_language ), 'yes');
                update_option('sitetran_target_languages', json_encode( $site_data->target_languages ), 'yes');
            }
        }


        // Function to save/update cache for one specific url (not for updating all urls at the same time)
        function SITETRAN_update_page_cache($page_id, $page_url) {
            global $wpdb;
            $sitetran_page_to_lang = $wpdb->prefix.'sitetran_page_to_lang';
            
            $sitetran_authentication_key = get_option('sitetran_authentication_key');

            // function is called to update languages in wp_options db table
            $this->SITETRAN_get_languages($sitetran_authentication_key);

            $sitetran_target_languages = json_decode(get_option('sitetran_target_languages'));

            // if SITETRAN_get_languages fails because of bad API key,  sitetran_target_langauges should be empty.
            if( ! $sitetran_target_languages || empty($sitetran_target_languages) || $sitetran_target_languages == '') {
                return false;
                exit;
            }

            foreach ($sitetran_target_languages as $language) {
            
                $apiUrl  = 'https://www.sitetran.com/api/get-static-translation?auth_key='.$sitetran_authentication_key.'&language_code='.$language.'&url='.$page_url;
                
                // getting response from api
                $response = wp_remote_request( esc_url_raw( $apiUrl ),
                    array(
                        'method'     => 'GET'
                    )
                );

                // Figure out how to handle these errors, maybe pass different codes for different failures
                // if ( is_wp_error( $response ) ) {
                //     "Error from wordpress accessing sitetran: " . $response->get_error_message();
                // }

                // if ( $response['response']['code'] != '200' ) {
                //     "Error from sitetran api: " . $response['response']['code']; 
                // }

                // The html_page is the exact HTML page downloaded from this wordpress site by the SiteTran API and then translated by SiteTran into the requested language.
                $html_page = wp_remote_retrieve_body($response);
                
                // if( empty($html_page) || $html_page == '' ) {
                //     // If the HTML page is empty, then there's nothing to translate and we don't need to save the result.
                //     // In fact, if there is an outage of some sort in wordpress, we would not want to save the empty string
                //     // because that would then make the wordpress outage worse.
                //     "Error: Empty translated page.";
                // }

                $cntSQL =  $wpdb->prepare( "SELECT count(*) AS count FROM {$sitetran_page_to_lang} WHERE language_code = %s and page_id = %s", $language, $page_id );
                $record = $wpdb->get_results($cntSQL, OBJECT);

                // if static translation isn't in the database add it, otherwise if it already exists update it
                if($record[0]->count == 0) { // add the record
                    $data = array(
                        'language_code'     => $language,
                        'page_id'           => $page_id,
                        'static_seo'        => 'Y', // We are not using this right now
                        'page_body'         => $html_page,
                    );

                    $wpdb->insert( $sitetran_page_to_lang, $data);
                } else { // update the record
                    $data = array(
                        'page_body'         => $html_page,
                    );

                    $condition = array(
                        'language_code'         => $language,
                        'page_id'           => $page_id,
                    );

                    $wpdb->update($sitetran_page_to_lang, $data, $condition);
                }

            }

            return true;
            exit;
        }

        // Function to save/update caches for all urls (for updating all urls at the same time)
        // TODO: we should use the SITETRAN_update_page_cache function in here
        function SITETRAN_update_all_caches($languages = array()) {
            global $wpdb;
            $sitetran_pages = $wpdb->prefix.'sitetran_pages';
            $sitetran_page_to_lang = $wpdb->prefix.'sitetran_page_to_lang';

            $sitetran_authentication_key = get_option('sitetran_authentication_key');

            // function is called to update languages in wp_options db table
            $this->SITETRAN_get_languages($sitetran_authentication_key);

            // Set target languages to the languages passed with the request from sitetran
            $sitetran_target_languages = $languages;

            // if no languages were passed with sitetran we set target languages to all languages in wordpress
            if( empty($sitetran_target_languages) || $sitetran_target_languages == '') {
                $sitetran_target_languages = json_decode(get_option('sitetran_target_languages'));
            }

            // Check if SITETRAN_get_languages is empty
            // if SITETRAN_get_languages fails because of bad API key,  sitetran_target_langauges should be empty.
            if( empty($sitetran_target_languages) || $sitetran_target_languages == '') {
                return false;
                exit;
            }

            foreach ($sitetran_target_languages as $language) {

                $getAllUrlsSQL = "SELECT page_id, page_url, translate_page, seo_page FROM {$sitetran_pages}";
                $getAllUrlsRecord = $wpdb->get_results($getAllUrlsSQL, OBJECT);

                foreach ($getAllUrlsRecord as $page_data) {
                    
                    if($page_data->translate_page === 'N') {
                        continue;
                    }

                    if($page_data->seo_page === 'N') {
                        continue;
                    }

                    $page_url = $page_data->page_url;
                    
                    $apiUrl  = 'https://www.sitetran.com/api/get-static-translation?auth_key='.$sitetran_authentication_key.'&language_code='.$language.'&url='.$page_url;

                    // getting response from api
                    $response = wp_remote_request( esc_url_raw( $apiUrl ),
                        array(
                            'method'     => 'GET'
                        )
                    );

                    

                    // if( is_wp_error( $response ) ) {
                    //     $body = esc_html__('There was an error');
                    //     return $body;
                    // }

                    $html_page = wp_remote_retrieve_body($response);
                    
                    // checking if sitetran_page_body exists in the database table
                    // wpdb::get_col( string|null $query = null, int $x )
                    $cntSQL =  $wpdb->prepare( "SELECT count(*) AS count FROM {$sitetran_page_to_lang} WHERE language_code = %s and page_id = %s", $language, $page_data->page_id );
                    $record = $wpdb->get_results($cntSQL, OBJECT);

                    //$body = '<h1>Hello World!</h1>';

                    //echo $body;

                    // if static translation isn't in the database add it, otherwise if it already exists update it
                    if($record[0]->count == 0) { // add the record
                        $data = array(
                            'language_code'     => $language,
                            'page_id'           => $page_data->page_id,
                            'static_seo'        => 'Y', // We are not using this right now
                            'page_body'         => $html_page,
                        );

                        $wpdb->insert( $sitetran_page_to_lang, $data);
                    } else { // update the record
                        $data = array(
                            'page_body'         => $html_page,
                        );

                        $condition = array(
                            'language_code'         => $language,
                            'page_id'           => $page_data->page_id,
                        );

                        $wpdb->update($sitetran_page_to_lang, $data, $condition);
                    }

                }
            }

            return true;
            exit;
        }

        // Function to generate new page-doc, as well as edit existing within SiteTran.
        function SITETRAN_generate_page_doc($post_id, $sitetran_authentication_key, $new_page) {
            
            if( $post_id == 0 ) { // post_id 0 is not a real post id
                return;
            }

            global $wpdb;
            $sitetran_pages = $wpdb->prefix.'sitetran_pages';

            $post_data = get_post( $post_id );
            $post_title = $post_data->post_title;
            $post_content = $post_data->post_content;

            // WP processes the raw post_content from the DB before it goes into the HTML.
            // These are some of the functions that almost every WP site uses.
            // More can be found here: https://wordpress.org/support/article/how-wordpress-processes-post-content/
            // TODO: we should make it optional for the user in our plugin settings to configure whether they have these settings enabled for their site (so that we can format the same way they do).
            $post_content = wpautop( $post_content );
            $post_content = wptexturize( $post_content );
            $post_content = convert_smilies( $post_content ); // This might only run if user enables it, which would be great. Need to test

            if($new_page) {
                $apiUrl  = 'https://www.sitetran.com/api/new-page-doc/';

                $body_data = array( 
                    'auth_key' => $sitetran_authentication_key,
                    'post_title' => $post_title,
                    'post_content' => $post_content,
                );
              
                // we're using wp_remote_post instead of wp_remote_request because it wasn't sending data with "problematic" characters like <> etc
                $request = wp_remote_post( esc_url_raw ($apiUrl), array( 'method' => 'POST', 'body' => $body_data));

                // getting response from api
                $response = wp_remote_retrieve_body($request);

                $response_object = json_decode($response);
                $sitetran_page_id = $response_object->page_id;

                if( ! $sitetran_page_id ) {
                    $sitetran_page_id = NULL;
                }

                // We add the sitetran_page_id to the sitetran_pages table
                $data = array(
                    'sitetran_page_id' => $sitetran_page_id,
                );

                $where = array(
                    'post_id' => $post_id,
                );

                $wpdb->update( $sitetran_pages, $data, $where);
            
            } else {

                // If a post is created in wordpress, and for some reason a page-doc is not able to be generated, for example if the post_content is empty, 
                // or if there is no title... Then this page will never get updated, so we can't use this line.
                // if( ! $sitetran_page_id ) {
                //     return;
                // }

                // We retrieve the sitetran_page_id
                $query = $wpdb->prepare( "SELECT sitetran_page_id FROM {$sitetran_pages} WHERE post_id = %s", $post_id );
                $record = $wpdb->get_results($query, OBJECT);
                $sitetran_page_id = $record[0]->sitetran_page_id;

                $apiUrl  = 'https://www.sitetran.com/api/edit-page-doc/';

                $body_data = array( 
                    'auth_key' => $sitetran_authentication_key,
                    'post_title' => $post_title,
                    'post_content' => $post_content,
                    'page_id' => $sitetran_page_id,
                );
              
                // we're using wp_remote_post instead of wp_remote_request because it wasn't sending data with "problematic" characters like <> etc
                $request = wp_remote_post( esc_url_raw ($apiUrl), array( 'method' => 'POST', 'body' => $body_data));

            }

        }

        function SITETRAN_check_plugin_conflicts() {
            
            $sitetran_had_conflict = false;

            $sitetran_all_conflicts = '<h2>SiteTran works best when it is the only translation plugin running on your WordPress site.</h2>
            <p>Remove or deactivate the following plugin(s):</p>';

            $sitetran_all_conflicts_plugins_array = array();

            // Other translation plugins array
            $sitetran_conflicts_plugins_check_array = array(
                'Translate WordPress with GTranslate' => 'gtranslate/gtranslate.php',
                'Translate Multilingual sites - TranslatePress' => 'translatepress-multilingual/index.php',
                'Loco Translate' => 'loco-translate/loco.php',
                'Polylang' => 'polylang/polylang.php',
                'Translate WordPress - Google Language Translator' => 'google-language-translator/google-language-translator.php',
                'Weglot Translate - Translate your WordPress website and go multilingual' => 'weglot/weglot.php',
                'Translate WordPress with ConveyThis' => 'conveythis-translate/index.php',
                'Automatic Translate Addon For Loco Translate' => 'automatic-translator-addon-for-loco-translate/automatic-translator-addon-for-loco-translate.php',
                'Automatic Translator with Google Translate' => 'auto-translate/auto-translate.php',
                'My WP Translate' => 'my-wp-translate/my-wp-translate.php',
                'Translate Words' => 'translate-words/translate-wp-words.php',
                'Automatic Translate Addon For TranslatePress' => 'automatic-translate-addon-for-translatepress/automatic-translate-addon-for-translatepress.php',
                'Google Website Translator' => 'google-website-translator/google-website-translator.php',
                'Advanced Google Translate' => 'advanced-google-translate/advanced-google-translate.php',
                'Lingotek Translation' => 'lingotek-translation/lingotek.php',
                'WP Auto Translate Free' => 'wp-auto-translate-free/wp-translatorea.php',
                'Multilanguage by BestWebSoft - WordPress Translation Plugin and Language Switcher' => 'multilanguage/multilanguage.php',
                'Gettext override translations' => 'gettext-override-translations/gettextoverridetranslations.php',
                'Translate WordPress Multilingual Sites - Transcy Translation Plugin' => 'transcy/transcy.php',
                'Polylang Connect for Elementor - Templates Translation & Language Switcher' => 'connect-polylang-elementor/connect-polylang-elementor.php',
                'WP Translate - WordPress Translation Plugin' => 'wp-translate/wp-translate.php',
                'Bravo Translate' => 'bravo-translate/bravo-translate.php',
                'Translate WordPress Websites with TextUnited' => 'text-united-translation/text-united-translation.php',
                'WP Override String Translations' => 'wp-override-translations/index.php',
                'WPGlobus - Multilingual Everything!' => 'wpglobus/wpglobus.php',
                'WooCommerce Multilingual & Multicurrency with WPML' => 'woocommerce-multilingual/wpml-woocommerce.php',
                'Translate Your WP Website Hassle Free!' => 'bablic/Bablic.php',
                'Falang multilanguage for WordPress' => 'falang/falang.php',
                'Localize - Website Translation Integration' => 'localizejs/localizejs.php',
                'Linguise - Automatic multilingual translation' => 'linguise/linguise.php',
                'Tranzly: AI DeepL WordPress Translation' => 'tranzly/tranzly.php',
                'Lokalise Companion Plugin' => 'lokalise/plugin.php',
            );

            // Checking if plugins are active
            foreach( $sitetran_conflicts_plugins_check_array as $plugin_name => $plugin_main_file_path ) {

                if ( is_plugin_active( $plugin_main_file_path ) ) {
                    $deactivate_link = wp_nonce_url('plugins.php?action=deactivate&amp;plugin='.urlencode($plugin_main_file_path ).'&amp;plugin_status=all&amp;paged=1&amp;s=', 'deactivate-plugin_' . $plugin_main_file_path);
                    $sitetran_all_conflicts_plugins_array[] = '<a href="'.$deactivate_link.'">Deactivate '.$plugin_name.'</a>';
                    $sitetran_had_conflict = true;
                }
            }

            $sitetran_all_conflicts_plugins_string = implode(", ",$sitetran_all_conflicts_plugins_array);
            $sitetran_all_conflicts = $sitetran_all_conflicts . '<p>' . $sitetran_all_conflicts_plugins_string . '</p>';

            if ( $sitetran_had_conflict ) {
                update_option('sitetran_had_conflict', 'true', 'yes');
                update_option('sitetran_plugin_conflict_message', $sitetran_all_conflicts, 'yes');
            } else {
                update_option('sitetran_had_conflict', '', 'yes');
            }
        }

        function SITETRAN_plugin_conflicts_notice() {

            $sitetran_plugin_conflict_message = get_option('sitetran_plugin_conflict_message');
            $sitetran_had_conflict = get_option('sitetran_had_conflict');
    
            // if plugin conflicts show error notice
            if ( $sitetran_had_conflict == 'true' ) {
                ?>
                <div class="notice sitetran_notice_main notice-error">
                    <span class="sitetran_notice_icon">
                        <img src="<?php echo esc_url(SITETRAN_PLUGIN_DIR."/images/widget-icons/new-st-box.svg"); ?>" alt="SiteTran" width="250">
                    </span>
                    <div class="sitetran_notice_content">
                        <?php echo $sitetran_plugin_conflict_message; ?>
                    </div>
                </div>
                <?php
            }
        }

        function SITETRAN_google_analytics_callback() {
            $sitetran_connect_google_analytics = sanitize_text_field( $_REQUEST['sitetran_connect_google_analytics'] );

            // If setting saved successfully then send success message
            if (update_option('sitetran_connect_google_analytics', $sitetran_connect_google_analytics, 'yes')) {
                $ajax_message = esc_html__("Google analytics settings updated");
                $ajax_response = array('status'=>'success', 'message' => $ajax_message);
                echo json_encode($ajax_response);
                exit;
            } else {
                $ajax_message = esc_html__("Failed to update google analytics settings");
                $ajax_response = array('status'=>'error', 'message' => $ajax_message);
                echo json_encode($ajax_response);
            }
            exit;
        }

        function SITETRAN_auto_detect_language_callback() {
            $sitetran_auto_detect_language = sanitize_text_field( $_REQUEST['sitetran_auto_detect_language'] );

            // If setting saved successfully then send success message
            if (update_option('sitetran_auto_detect_language', $sitetran_auto_detect_language, 'yes')) {
                $ajax_message = esc_html__("Auto detect language settings updated");
                $ajax_response = array('status'=>'success', 'message' => $ajax_message);
                echo json_encode($ajax_response);
                exit;
            } else {
                $ajax_message = esc_html__("Failed to update auto detect language settings");
                $ajax_response = array('status'=>'error', 'message' => $ajax_message);
                echo json_encode($ajax_response);
            }
            exit;
        }

        // Send site data to SiteTran and update WordPress database
        function SITETRAN_send_and_save_data_on_auth_callback() {
            global $wpdb;
            $sitetran_pages = $wpdb->prefix.'sitetran_pages';
            $sitetran_authentication_key = get_option('sitetran_authentication_key');
            
            // Update status values in database
            // sitetran_pages_sent value ensures we only send data once
            // sitetran_intialize_success_message_seen value ensures we only see the success message once
            update_option('sitetran_pages_sent', 'N', 'yes');
            update_option('sitetran_intialize_success_message_seen', 'N', 'yes');

            // We are inserting all urls in sitetran_pages db table as we got valid response and auth is successful
            // We ALSO use this to get the sitetran_page_id and create the new-page-doc for existing posts for the newly initialized plugins.
            // $cntTableSQL =  $wpdb->prepare( "SELECT count(*) AS count FROM {$sitetran_pages}" );
            // $cntTableSQL =  "SELECT count(*) AS count FROM {$sitetran_pages}";
            $cntTableSQL = $wpdb->get_var( "SELECT COUNT(*) FROM {$sitetran_pages}" );
            // exit;
            // $tableRecord = $wpdb->get_results($cntTableSQL, OBJECT);

            // If the table is empty 
            if($cntTableSQL == 0) {
                $page_urls = $this->SITETRAN_get_all_site_urls();

                // print_r($page_urls);
                // exit;

                // $languages = array('hi', 'es');

                //foreach ($languages as $language) {
                    foreach ($page_urls as $page_data) {
                        
                        $page_url = $page_data['page_url'];

                        $data = array(
                            'post_id'                   => $page_data['post_id'],
                            'page_url'                  => $page_url,
                            'translate_page'            => 'Y',
                            'seo_page'                  => 'N',
                        );

                        $wpdb->insert( $sitetran_pages, $data);

                        $this->SITETRAN_generate_page_doc($page_data['post_id'], $sitetran_authentication_key, true);
                    }
                //}
            }

            // after all data is sent, update sitetran_pages_sent to 'Y'
            update_option('sitetran_pages_sent', 'Y', 'yes');

            $ajax_message = esc_html__("Successfully sent your site's data to SiteTran");
            $ajax_response = array('status'=>'success', 'message' => $ajax_message);
            echo json_encode($ajax_response);
            exit;
        }

        // Get database values to check if initialize success message was already seen by user
        function SITETRAN_pages_sent_status_message_callback() {
            $sitetran_pages_sent = get_option('sitetran_pages_sent');
            $sitetran_intialize_success_message_seen = get_option('sitetran_intialize_success_message_seen', 'N');
            
            $ajax_response = array('sitetran_pages_sent' => $sitetran_pages_sent, 'sitetran_intialize_success_message_seen' => $sitetran_intialize_success_message_seen);
            echo json_encode($ajax_response);
            exit;
        }

        // Update sitetran_intialize_success_message_seen to 'Y'
        // This tells us that user has seen initialize success message
        function SITETRAN_update_intialize_message_status_callback() {
            update_option('sitetran_intialize_success_message_seen', 'Y', 'yes');
            $ajax_response = array('status'=>'success');
            echo json_encode($ajax_response);
            exit;
        }

        function init() {
            add_action( 'admin_menu', array($this, 'SITETRAN_plugin_settings_page' ));
            add_action( 'init',  array($this, 'SITETRAN_plugin_save_settings'));
            add_action( 'admin_init',  array($this, 'SITETRAN_check_plugin_conflicts'));
            add_action( 'admin_notices', array($this, 'SITETRAN_plugin_conflicts_notice'));
            add_action( 'wp_ajax_sitetran_dnt_ajax', array($this, 'SITETRAN_dnt_ajax_callback') );
            add_action( 'wp_ajax_nopriv_sitetran_dnt_ajax', array($this, 'SITETRAN_dnt_ajax_callback') );
            add_action( 'wp_ajax_sitetran_dns_ajax', array($this, 'SITETRAN_dns_ajax_callback') );
            add_action( 'wp_ajax_nopriv_sitetran_dns_ajax', array($this, 'SITETRAN_dns_ajax_callback') );
            add_action( 'wp_ajax_sitetran_upseo_ajax', array($this, 'SITETRAN_upseo_ajax_callback') );
            add_action( 'wp_ajax_nopriv_sitetran_upseo_ajax', array($this, 'SITETRAN_upseo_ajax_callback') );
            add_action( 'wp_ajax_sitetran_update_caches_ajax', array($this, 'SITETRAN_update_caches_callback') );
            add_action( 'wp_ajax_nopriv_sitetran_update_caches_ajax', array($this, 'SITETRAN_update_caches_callback') );
            add_action( 'wp_ajax_sitetran_google_analytics_ajax', array($this, 'SITETRAN_google_analytics_callback') );
            add_action( 'wp_ajax_nopriv_sitetran_google_analytics_ajax', array($this, 'SITETRAN_google_analytics_callback') );
            add_action( 'wp_ajax_sitetran_auto_detect_language_ajax', array($this, 'SITETRAN_auto_detect_language_callback') );
            add_action( 'wp_ajax_nopriv_sitetran_auto_detect_language_ajax', array($this, 'SITETRAN_auto_detect_language_callback') );
            add_action( 'wp_ajax_nopriv_sitetran_send_and_save_data_on_auth_ajax', array($this, 'SITETRAN_send_and_save_data_on_auth_callback') );
            add_action( 'wp_ajax_sitetran_send_and_save_data_on_auth_ajax', array($this, 'SITETRAN_send_and_save_data_on_auth_callback') );
            add_action( 'wp_ajax_nopriv_sitetran_pages_sent_status_message_ajax', array($this, 'SITETRAN_pages_sent_status_message_callback') );
            add_action( 'wp_ajax_sitetran_pages_sent_status_message_ajax', array($this, 'SITETRAN_pages_sent_status_message_callback') );
            add_action( 'wp_ajax_nopriv_sitetran_update_intialize_message_status_ajax', array($this, 'SITETRAN_update_intialize_message_status_callback') );
            add_action( 'wp_ajax_sitetran_update_intialize_message_status_ajax', array($this, 'SITETRAN_update_intialize_message_status_callback') );
            add_action( 'transition_post_status', array($this, 'SITETRAN_save_url_to_db_on_new_post_publish'), 10, 3 );
        }


        public static function SITETRAN_instance() {
            if (!isset(self::$SITETRAN_instance)) {
                self::$SITETRAN_instance = new self();
                self::$SITETRAN_instance->init();
            }
            return self::$SITETRAN_instance;
        }
    }
    SITETRAN_backend::SITETRAN_instance();
}


// WP_List_Table is not loaded automatically so we need to load it in our application
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Create a new table class that will extend the WP_List_Table
 */
// Here is the Class to Create Table for All Urs List Table for Tab = Pages
class Sitetran_All_Urls_List_Table extends WP_List_Table
{
    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $data = $this->table_data();
        usort( $data, array( &$this, 'sort_data' ) );

        $perPage = 20;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);

        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );

        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);

        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }

    /**
     * Override the parent columns method. Defines the columns to use in your listing table.
     *
     * @return Array
     */
    public function get_columns()
    {
        // Define tooltip texts for various columns using translation function for localization.
        $tooltip_text_translate = esc_html__( 'Check this if you want your page translated. The SiteTran widget will get added to that page.', SITETRAN_DOMAIN );
        $tooltip_text_seo = esc_html__( 'Check this if you want language codes in your URLs, and for the translations on the page to be indexed by Google.', SITETRAN_DOMAIN );
        $tooltip_text_cache = esc_html__( 'Updates the cached translations for this page, for SEO.', SITETRAN_DOMAIN );

        // Create info images with tooltips for various columns. These images provide additional information to the user.
        $info_image_translate =  '<img class="sitetran-info-image" data-tippy-content="'.$tooltip_text_translate.'" src="'.esc_url(SITETRAN_PLUGIN_DIR."/images/sitetran-info-icon.svg").'" />';
        $info_image_seo =  '<img class="sitetran-info-image" data-tippy-content="'.$tooltip_text_seo.'" src="'.esc_url(SITETRAN_PLUGIN_DIR."/images/sitetran-info-icon.svg").'" />';
        $info_image_cache =  '<img class="sitetran-info-image" data-tippy-content="'.$tooltip_text_cache.'" src="'.esc_url(SITETRAN_PLUGIN_DIR."/images/sitetran-info-icon.svg").'" />';

        // Define the columns for the table. Each column has a title and an associated info image.
        $columns = array(
            'page-url'          => '<span class="sitetran-table-column-title">'.esc_html__( 'Page Url', SITETRAN_DOMAIN ).'</span>',
            'translate-page'    => '<span class="sitetran-table-column-title">'.esc_html__( 'Translate', SITETRAN_DOMAIN ).$info_image_translate.'</span>',
            'needs-seo'         => '<span class="sitetran-table-column-title">'.esc_html__( 'Use SEO', SITETRAN_DOMAIN ).$info_image_seo.'</span>',
            'update-seo'        => '<span class="sitetran-table-column-title">'.esc_html__( 'Update SEO Translations', SITETRAN_DOMAIN ).$info_image_cache.'</span>',
        );

        // Return the defined columns.
        return $columns;
    }


    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
        return array();
    }

    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns()
    {
        return array('page-url' => array('page-url', false));
    }

    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data()
    {
        $data = array();

        // getting array of all page/post urls, skipped taxonomy urls (categories, tags, product-categories)
        // permalinks settings -> wp-admin/options-permalink.php
        /*$page_urls = array();

        //condition to add this code only if home page is set as "Your latest posts"
        $page_data_home['post_id'] = get_option('page_on_front');
        $page_data_home['url'] = home_url();
        $page_urls[] = $page_data_home;

        $posts = new WP_Query('post_type=any&posts_per_page=-1&post_status=publish');
        
        $posts = $posts->posts;
        foreach($posts as $post) {
            switch ($post->post_type) {
                case 'revision':
                case 'nav_menu_item':
                    break;
                case 'page':
                    $permalink = get_page_link($post->ID);
                    break;
                case 'post':
                    $permalink = get_permalink($post->ID);
                    break;
                case 'attachment':
                    $permalink = get_attachment_link($post->ID);
                    break;
                default:
                    $permalink = get_post_permalink($post->ID);
                    break;
            }
            $page_data['post_id'] = $post->ID;
            $page_data['url'] = $permalink;
            $page_urls[] = $page_data;
        }*/


        //$page_urls = SITETRAN_backend::SITETRAN_get_all_site_urls();
        global $wpdb;
        $sitetran_pages = $wpdb->prefix.'sitetran_pages';
        // We need to work on WHERE condition 'sitetran_language_code'
        $getUrlsTableSQL = "SELECT page_id, page_url, translate_page, seo_page FROM {$sitetran_pages}";
        $getUrlsTableRecord = $wpdb->get_results($getUrlsTableSQL, OBJECT);

        // echo '<pre>';
        // print_r($getUrlsTableRecord);
        // echo '</pre>';
        // exit;

        $data = array();
        foreach($getUrlsTableRecord as $page_data) {

            $sitetranTranslate = $page_data->translate_page;
            $sitetranSeo = $page_data->seo_page;

            $sitetranTranslate_checked = '';
            $sitetranSeo_checked = '';
            $sitetran_upseo = 'disabled';

            if($sitetranTranslate == 'Y') {
                $sitetranTranslate_checked = 'checked';
            }

            if($sitetranSeo == 'Y') {
                $sitetranSeo_checked = 'checked';
                $sitetran_upseo = '';
            }

            $data[] = array(
                    'page-url'              => $page_data->page_url,
                    'translate-page'        => '<input type="checkbox" class="sitetran-dnt" '.esc_html($sitetranTranslate_checked).' page_id="'.esc_attr($page_data->page_id).'" name="sitetran-dnt" value="1">',
                    'needs-seo'             => '<input type="checkbox" class="sitetran-dns" '.esc_html($sitetranSeo_checked).' page_id="'.esc_attr($page_data->page_id).'" page_url="'.esc_url($page_data->page_url).'" name="sitetran-dns" value="1">',
                    'update-seo'            => '<input type="button" class="button-primary sitetran-upseo" '.esc_html($sitetran_upseo).' page_id="'.esc_attr($page_data->page_id).'" page_url="'.esc_url($page_data->page_url).'" value="'.esc_html__( 'Update', SITETRAN_DOMAIN ).'">',
                    );
        }

        return $data;
    }

    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default( $item, $column_name )
    {
        switch( $column_name ) {
            case 'page-url':
            case 'translate-page':
            case 'needs-seo':
            case 'update-seo':
                return $item[ $column_name ];

            default:
                return print_r( $item, true ) ;
        }
    }

    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data( $a, $b )
    {
        // Set defaults
        $orderby = 'page-url';
        $order = 'asc';

        // If orderby is set, use this as the sort column
        if(!empty($_GET['orderby']))
        {
            $orderby = sanitize_text_field($_GET['orderby']);
        }

        // If order is set use this as the order
        if(!empty($_GET['order']))
        {
            $order = sanitize_text_field($_GET['order']);
        }


        $result = strcmp( $a[$orderby], $b[$orderby] );

        if($order === 'asc')
        {
            return $result;
        }

        return -$result;
    }
}