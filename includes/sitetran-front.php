<?php

if (!defined('ABSPATH'))
  exit;

if (!class_exists('SITETRAN_frontend')) {

  class SITETRAN_frontend {

    protected static $instance;

    // Function to get current page whole url
    function SITETRAN_current_page_url() {
      if (isset($_SERVER['HTTPS']) &&
          ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
          isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
          $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
          $protocol = 'https';
      } else {
          $protocol = 'http';
      }
      
      $current_page_url = esc_url_raw( wp_unslash( $_SERVER['HTTP_HOST'] ) ) . esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) );
      
      $cpu_a = explode(':', $current_page_url, 2);
      $cpu_a[0] = $protocol;
      return implode(":", $cpu_a);
    }

    // We can get settings from sitetran_pages db table for current page
    function SITETRAN_get_current_page_sitetran_db_settings($cur_page_url) {
      global $wpdb;
      $sitetran_pages = $wpdb->prefix.'sitetran_pages';

      $sitetran_page_settings = array();
      $sitetran_page_settings['record'] = '';
      $sitetran_page_settings['translate'] = '';
      $sitetran_page_settings['seo'] = '';

      // If page id = 0 then use whole url of the page to get translate_page and seo_page value from db
      // echo $cur_post_id = get_the_ID();
      // echo '<br>';
      
      // echo '<br>';
      // echo $site_url = site_url().'/';
      // echo '<br>';
      $cur_post_id = url_to_postid( $cur_page_url );
      // echo '<br>';
      // $url = explode( '?', $cur_page_url );
      // echo $no_query_args = $url[0];

      // WE NEED TO FIGURE OUT HOW TO GET THE RIGHT POST_ID BUT SOMETIMES IF THE PAGE IS THE HOMEPAGE OR ARCHIVE PAGE OR CATEGORY PAGE THEN WE CAN HAVE SOME SURPRISES
      // WILL RETURN POST_ID = 0
      // ALSO WE NEED TO FIGURE IT OUT ABOUT URL QUERY PARAMETERS
      // THERE IS A CONFLICT WHEN SOME PAGE IS SET AS A HOMEPAGE
      // We tried to solve the conflict by adding the if statement below.
      // Another thing to note is that if the homepage is set to a post and the homepage has seo = "Y" but the post has seo = "N" then we hope that the post redirects to the homepage.
      if($cur_post_id == 0 || is_front_page()) {
        // And we are going to get and use for translate and seo value for the homepage url
        // We use the page url instead of post id to get the translate/seo values 
        $getPageDataSQL =  $wpdb->prepare( "SELECT translate_page, seo_page FROM {$sitetran_pages} WHERE page_url = %s", $cur_page_url );  
      } else {
        $getPageDataSQL =  $wpdb->prepare( "SELECT translate_page, seo_page FROM {$sitetran_pages} WHERE post_id = %s", $cur_post_id );
      }

      
      //$getPageDataSQL = "SELECT translate_page, seo_page FROM {$sitetran_pages} WHERE page_url = '$cur_page_url'";
      $getPageDataRecord = $wpdb->get_results($getPageDataSQL, OBJECT);

      // If the page is found in the sitetran_pages table then we have the values otherwise if page is not in table then just put the widget on the page without SEO
      // This is needed for pages that don't have post ids. Like archive pages: category pages, search pages...
      if(!empty($getPageDataRecord)) {
        $sitetran_page_settings['record'] = 'Y';
        $sitetran_page_settings['translate'] = $getPageDataRecord[0]->translate_page;
        $sitetran_page_settings['seo'] = $getPageDataRecord[0]->seo_page;

        //$page_id = $this->get_page_ID();
        //echo $page_id;


        // We're not using this apparently. It was an attempt to get the page_id
        // $url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'REQUEST_URI' ];
        // echo $cur_post_id = url_to_postid( $url );

        //$mypost_id = url_to_postid( 'http://localhost/wordpress/wordpress-shop-demo/shop/' );


        // WE SHOULD CONSIDER STORING THE TRANSLATE/SEO = Y/N DATA IN OUR OWN TABLE!!!

        // We get the sitetran-translate value to know if to translate or not.
        // $sitetranCheckIfTranslate = get_post_meta( $pageId, 'sitetran-translate', true );
        // if not defined, then we know that it's yes, translate this page..
        // if (!$sitetranCheckIfTranslate) {
        //   $sitetranCheckIfTranslate = 'yes';
        // }

        // We get the sitetran-seo value to know if to do SEO or not, which means adding the static_url_language_code_lookup in widget initialization.
        // $sitetranCheckIfSEO = get_post_meta( $pageId, 'sitetran-seo', true );
        // if not defined, then we know that it's yes, use SEO.
        // if (!$sitetranCheckIfSEO) {
        //   $sitetranCheckIfSEO = 'yes';
        // }
      }

      return $sitetran_page_settings;
    }
    
    // getting urllookup string
    function SITETRAN_language_url_lookup_string($cur_page_url) {
      $sitetran_target_languages = json_decode( get_option('sitetran_target_languages') );

      // This is how we generate page slugs, we also do something similar in sitetran-backend.php
      // $permalink = esc_url( get_permalink() );
      $site_url = get_site_url().'/';
      if ( is_front_page() ) {
        // if current page is homepage, then there is no $page_slug
        $page_slug = '';
      } else {
        // otherwise, we just want the page slug
        $page_slug = str_replace($site_url, "", $cur_page_url);
      }
      
      // We might need to get default language from wordpress to use that here.
      // Or, even better, the API request for language_codes, can mark the original language.
      // Default language_code doesn't belong in this
      $langUrlLookupString = array();

      // This is for sitetran.static_url_language_code_lookup
      // For original lang
      $sitetran_original_language_code = get_option('sitetran_original_language_code');
      $langUrlLookupString[] = '"'.$sitetran_original_language_code.'":"'.$cur_page_url.'"';

      // For all other langs
      foreach ($sitetran_target_languages as $language) {
        $langUrlLookupString[] = '"'.$language.'":"'.$site_url.$language.'/'.$page_slug.'"';
        // $langUrlLookupString[$language] = $site_url.$language.'/'.$page_slug;
      }

      $langUrlLookupString = implode(",\n\t\t\t\t", $langUrlLookupString); // \n\t\t\t\t for proper indentation
      return $langUrlLookupString;
    }

    // For generating the hreflangs, very similar to above SITETRAN_language_url_lookup_string
    function SITETRAN_get_languages_and_urls($cur_page_url) {
      $sitetran_target_languages = json_decode( get_option('sitetran_target_languages') );

      // This is how we generate page slugs, we also do something similar in sitetran-backend.php
      // $permalink = esc_url( get_permalink() );
      $site_url = get_site_url().'/';
      if ( is_front_page() ) {
        // if current page is homepage, then there is no $page_slug
        $page_slug = '';
      } else {
        // otherwise, we just want the page slug
        $page_slug = str_replace($site_url, "", $cur_page_url);
      }

      $languages_urls = array();

      // For original lang
      $sitetran_original_language_code = get_option('sitetran_original_language_code');
      $languages_urls[$sitetran_original_language_code] = $cur_page_url;

      // For all other langs
      foreach ($sitetran_target_languages as $language) {
        $languages_urls[$language] = $site_url.$language.'/'.$page_slug.'"';
      }

      return $languages_urls;
    }

    // function to decide about phrase discovery enable/disable
    function SITETRAN_phrase_discovery_enabled() {

      $phrase_discovery_enabled = '';
      // We are preventing phrase discovery for admin and other admin level user roles
      if( current_user_can('administrator') || current_user_can('editor') || current_user_can('author') || current_user_can('contributor') ) {
        $phrase_discovery_enabled = 'disable';
      }

      $sitetran_had_conflict = get_option('sitetran_had_conflict');
      // We are preventing phrase discovery if another translation plugin is active
      if($sitetran_had_conflict == 'true') {
        $phrase_discovery_enabled = 'disable';
      }

      return $phrase_discovery_enabled;
    }

    function SITETRAN_get_widget_code($is_default) {

      $sitetran_authentication_key = get_option('sitetran_authentication_key');

      // If authentication key is not saved in db then not adding widget to site
      if(empty($sitetran_authentication_key) ) {
        return;
      }

      $default_widget_class = '';
      if($is_default) {
        $default_widget_class = 'class="sitetran-default-widget"';
      }

      $cur_page_url = $this->SITETRAN_current_page_url();
      $phrase_discovery = $this->SITETRAN_phrase_discovery_enabled();
      $sitetran_widget_icon = get_option( 'sitetran_widget_icon', 'use_icon' );
      $sitetran_widget_icon_svg = get_option( 'sitetran_widget_icon_svg', 'new-st-box.svg' );
      $sitetran_site_id = get_option('sitetran_site_id');
      $sitetran_original_language_code = get_option('sitetran_original_language_code');
      $sitetran_widget_type = 'styled-select';
      $sitetran_connect_google_analytics = get_option('sitetran_connect_google_analytics', 'N');
      $sitetran_auto_detect_language = get_option('sitetran_auto_detect_language', 'Y');

      // $sitetran_widget_type = get_option( 'sitetran_widget_type', 'styled-select' );        
      // We are using url of the page to get translate_page and seo_page value from db

      $current_page_db_settings = $this->SITETRAN_get_current_page_sitetran_db_settings($cur_page_url);

      // if page is not checked for "Translate" then we don't add the widget to the page.
      if($current_page_db_settings['translate'] == 'N') {
        return;
      }

      // If the page is found in the sitetran_pages table then we have the values otherwise if page is not in table then just put the widget on the page without SEO
      // This is needed for pages that don't have post ids. Like archive pages: category pages, search pages...

      // We are adding widget icon based on plugin settings
      // If use seo is yes, we get the available language codes (for now all) for the given page, and generate the static_url_language_code_lookup for each page.
      // else page is not in table then just put the widget on the page without SEO
      // We are preventing phrase discovery for admin and other admin level user roles
      // also maybe need to include option for Verified Phrase Discovery
      ?>
      <!-- SiteTran Begin -->
      
      <div <?php echo $default_widget_class; ?> id="sitetran_translate_wrapper">
        
        <?php
        if($sitetran_widget_icon == 'use_icon') {
        ?>
        <img id="sitetran_toggle" src="<?php echo esc_url( SITETRAN_PLUGIN_DIR . '/images/widget-icons/' . $sitetran_widget_icon_svg); ?>" width="19" height="20" />
        <?php
        }
        ?>

        <div id="sitetran_translate_element"></div>
      </div>
        
      <script>
        var sitetran = {};
        sitetran.site_id = '<?php echo esc_html( $sitetran_site_id ); ?>';
        sitetran.site_default_language_code = '<?php echo esc_html( $sitetran_original_language_code ); ?>';
        sitetran.url_type = 'none';
        sitetran.widget_type = '<?php echo esc_html( $sitetran_widget_type ); ?>';
        <?php
        if($current_page_db_settings['seo'] == 'Y') {
          $langUrlLookupString = $this->SITETRAN_language_url_lookup_string($cur_page_url);
        ?>
sitetran.static_url_language_code_lookup = {
          <?php echo $langUrlLookupString; ?>

        };
<?php } ?>
<?php if( $phrase_discovery == 'disable' ) { ?>
sitetran.phrase_discovery_enabled = false;
        sitetran.refresh_cache = true;
<?php } ?>
<?php if( $sitetran_connect_google_analytics == 'Y' ) { ?>
        try {
          sitetran.language_change_function = function(language_code) {
            gtag("event", language_code, { event_category : "sitetran-language" });
          }
        } catch (error) {
          console.error(error);
        }
<?php } ?>
<?php if( $sitetran_auto_detect_language == 'Y' ) { ?>
        sitetran.auto_switch_from_browser_lang = true;
<?php } ?>
      </script>
      <!-- SiteTran End -->
      
      <?php
    }

    function SITETRAN_footer_language_switcher_callback() {
        
      // if shortcode is used, this variable should be set before we get here
      global $SITETRAN_is_using_shortcode;
      if($SITETRAN_is_using_shortcode) {
        return;
      }

      $this->SITETRAN_get_widget_code(true);
    }

    /*function my_awesome_func( $data ) {
      
      ob_start();
      ?>
      <html><head></head><body><h1>hello world</h1></body></html>
      <?php
      
      $html = ob_get_clean();

      return $html;
    }*/

    // This is a work in progress solution to get the post_id
    // So that we know if to put the widget on the page/do seo.
    // The issue is that archive pages returns the post_id of the last post from the loop.
    // function get_page_ID() {
    //   //if on the blog page
    //   if ( is_home() && ! in_the_loop() ) {
    //     $ID = get_option('page_for_posts');
    //   } elseif ( is_post_type_archive()) {
    //     $query = get_queried_object();
    //     $slug = $query->name;
    //     $pageobj = get_page_by_path($slug);
    //     $ID = $pageobj->ID;
    //   } else {
    //     $ID = get_the_ID();
    //   }
    //   return $ID;
    // }

    function SITETRAN_generate_rewrite_rules() {
      // do we want to add the original language here? Is that problematic?
      // Will that produce duplicate content? maybe better not to do it.
      // So this means that we don't add the language code in the hreflangs.
      $sitetran_target_languages = json_decode( get_option('sitetran_target_languages') );
      //$languages_array = array('en', 'hi', 'fr', 'es');

      // We should flush the rewrite rules for permalinks whenever there is a change in the language codes
      // Languages added/removed.
      // Also, if a new page is added or removed...
      // Or if a page gets translate-this-page/seo-this-page set to yes/no.
      // maybe more.
      $languages_old = array('de');

      array_multisort($languages_old);
      array_multisort($sitetran_target_languages);

      // for each value in array 1, loop through array 2 and see if they match.

      if (serialize($languages_old) !== serialize($sitetran_target_languages) ) {
        update_option('sitetran_flush_rewrite_rules', 'true', 'yes');
      }

      foreach ($sitetran_target_languages as $language) {
        
        // If we have the page set to 'do not translate', then we don't create these endpoints.
        // Similarly if the page is set to 'without SEO', then we don't create these endpoints.

        // Here we add just language code for the translated homepages
        // $wp_rewrite->rules = array_merge(
        //     [$language => 'index.php?lang='.$language],
        //     $wp_rewrite->rules
        // );
        add_rewrite_rule( '^'.$language.'/?$', 'index.php?lang='.$language, 'top' );

        // Here we add language code and slug (path) for other translated pages
        // $wp_rewrite->rules = array_merge(
        //     [$language.'/(.*)$' => 'index.php?lang='.$language.'&slug=$matches[1]'],
        //     $wp_rewrite->rules
        // );

        add_rewrite_rule( '^'.$language.'/(.*)$', 'index.php?lang='.$language.'&slug=$matches[1]', 'top' );
      }
    }

    function SITETRAN_query_vars($query_vars) {
      $query_vars[] = 'lang';  
      $query_vars[] = 'slug';
      return $query_vars;
    }

    function SITETRAN_template_redirect() {
      $lang = get_query_var( 'lang' );
      $slug = get_query_var( 'slug' );

      // Created page_url from slug
      $page_url = site_url('/').$slug; // NOW WE ARE USING site_url('/') INSTEAD OF site_url().'/'
      // echo '<br>';

      // Getting post_id from page_url
      $post_id = url_to_postid($page_url);
      // echo '<br>';

      // we make request to db to get the translate/seo values for the page_url.
      // Getting page_body from the db 
      global $wpdb;
      $sitetran_pages = $wpdb->prefix.'sitetran_pages';
      $sitetran_page_to_lang = $wpdb->prefix.'sitetran_page_to_lang';

      // If post_id == 0 or it's homepage then use page_url as a key to get data from db otherwise use post_id as a key to get data from db
      if($post_id == 0 || $page_url == site_url('/')) {
        $translate_page_data =  $wpdb->prepare( "SELECT
          ss.page_body,
          pm.translate_page,
          pm.seo_page
          FROM {$sitetran_page_to_lang} ss
          JOIN {$sitetran_pages} pm 
          ON ss.page_id = pm.page_id
          WHERE ss.language_code = %s
          AND pm.page_url = %s",
          $lang,
          $page_url
        );

        

      } else {
        $translate_page_data =  $wpdb->prepare( "SELECT
          ss.page_body,
          pm.translate_page,
          pm.seo_page
          FROM {$sitetran_page_to_lang} ss
          JOIN {$sitetran_pages} pm 
          ON ss.page_id = pm.page_id
          WHERE ss.language_code = %s
          AND pm.post_id = %s",
          $lang,
          $post_id
        );
      }
      $record = $wpdb->get_results($translate_page_data, OBJECT);

      // print_r($record);
      // $translate_page_data = "SELECT
      //   ss.page_body,
      //   pm.meta_key,
      //   pm.meta_value
      //   FROM {$sitetran_page_to_lang} ss
      //   JOIN {$sitetran_pages} pm 
      //   ON ss.page_id = pm.page_id
      //   WHERE ss.language_code = '$lang'
      //   AND ss.sitetran_language_code = '$lang'";
      // $record = $wpdb->get_results($translate_page_data, OBJECT);

      // $body = $record[0]->sitetran_page_body;
      // echo $record;
      
      // echo $slug;
      // echo '<br>';
      // echo $lang;
      //exit;

      // echo '<pre>';
      // print_r($record);
      // echo '</pre>';


      // THIS IS WHERE WE LEFT OFF.

      // We loop through the results. Because of our *current* crappy db situation, 
      // we get 3 rows from the db.

      // foreach ($record as $data) {
      //   if(data->meta_key == 'sitetran-translate') {
      //     if(data->meta_value == 'yes') {
      //       $sitetran_translate = true;
      //     }
      //   }
      //   if(data->meta_key == 'sitetran-seo') {
      //     if(data->meta_value == 'yes') {
      //       $sitetran_seo = true;
      //       $translated_body = data->sitetran_page_body;
      //       // We only need to get the body if sitetran-seo is true.
      //     }
      //   }
      // }


      //  sitetran_seo_id, sitetran_page_id, sitetran_language_code, sitetran_page_slug

      // we need to deal with the mess from // pm.sitetran_translate, pm.sitetran_seo

      // if the slug is one of the pages that we don't want to translate, 
      // then we go to the next wordpress function - sitetrans doesn't it touch it
      // same goes for no seo 
      //echo $lang;

      // If language code then we go to translate.php
      if ( $lang ) {
          include plugin_dir_path( __FILE__ ) . 'templates/translate.php';
          die;
      }

    }
  
    // For adding code into site's head
    function SITETRAN_head_callback() {
      $cur_page_url = $this->SITETRAN_current_page_url();
      $current_page_db_settings = $this->SITETRAN_get_current_page_sitetran_db_settings($cur_page_url);

      if(!empty($current_page_db_settings['record'])) {
                
        //if page is checked for "Use SEO" then we add hreflangs to the original language page.
        if($current_page_db_settings['seo'] == 'Y') {
          $SITETRAN_get_languages_and_urls = $this->SITETRAN_get_languages_and_urls($cur_page_url);

          foreach($SITETRAN_get_languages_and_urls as $language => $url) {
            echo '<link rel="alternate" hreflang="'.$language.'" href="'.$url.'">';
          }

        }
      }
    }

    function SITETRAN_flush_rewrite_rules() {
      $sitetran_flush_rewrite_rules = get_option( 'sitetran_flush_rewrite_rules', 'true' );
      
      if( $sitetran_flush_rewrite_rules == 'true' || $sitetran_flush_rewrite_rules == 'changed' ) {
        //echo $sitetran_flush_rewrite_rules;
        flush_rewrite_rules();
        update_option('sitetran_flush_rewrite_rules', 'false', 'yes');
        //exit;
        //flush_rewrite_rules();
      }

    }

    // The shortcode function for language switcher
    function SITETRAN_language_switcher_shortcode() { 
      
      global $SITETRAN_is_using_shortcode;

      // If we already have shortcode on the page, then return
      if ( $SITETRAN_is_using_shortcode ) {
        return;
      }
      $SITETRAN_is_using_shortcode = true;

      ob_start();
      $this->SITETRAN_get_widget_code(false);
      $content = ob_get_clean();

      return $content;
    }

    // We make multilingual search work
    function SITETRAN_search_form_modify($input) {
      
      // Only execute if it's search form
      if ( is_search() && isset($_GET['s'])) {

        if ( isset($_COOKIE['sitetran_lang']) ) { // Only execute if sitetran_lang cookie is found
          $sitetran_original_language_code = get_option('sitetran_original_language_code');
          $user_selected_lang = $_COOKIE['sitetran_lang'];
          $search_query = $_GET['s'];
    
          // If sitetran_lang cookie is same as default language then return
          if ( $user_selected_lang == $sitetran_original_language_code ) {
            return $input;
          }
    
          global $wpdb;
          $sitetran_pages = $wpdb->prefix.'sitetran_pages';
          $sitetran_page_to_lang = $wpdb->prefix.'sitetran_page_to_lang';
          
          // We get translated posts based on translated search query and language code
          // This is for default wordpress search
          $input = "SELECT wp_posts.*
          FROM wp_posts
          JOIN $sitetran_pages sp
          ON sp.post_id = wp_posts.ID
          JOIN $sitetran_page_to_lang sptl
          ON sptl.page_id = sp.page_id 
          AND sptl.page_body LIKE CONCAT('%', '$search_query', '%')
          AND sptl.language_code = '$user_selected_lang'
          WHERE (
            (wp_posts.post_type = 'post' AND (wp_posts.post_status = 'publish')) 
            OR (wp_posts.post_type = 'page' AND (wp_posts.post_status = 'publish')) 
            OR (wp_posts.post_type = 'attachment' AND (wp_posts.post_status = 'publish')) 
            OR (wp_posts.post_type = 'product' AND (wp_posts.post_status = 'publish'))
          ) 
          ORDER BY wp_posts.post_title DESC, wp_posts.post_date DESC LIMIT 0, 10";

          // This is for woocommerce product search filtering
          if ( isset( $_GET['post_type'] ) && $_GET['post_type'] == 'product' ) {

            $order_by_sql = "ORDER BY wp_posts.menu_order ASC, wp_posts.post_title ASC LIMIT 0, 12"; // default orderby query

            if ( isset($_GET['orderby']) && $_GET['orderby'] != '' ) { // if orderby is set and not empty
              
              if ( $_GET['orderby'] == 'menu_order' ) { // if orderby set to default sorting
                $order_by_sql = "ORDER BY wp_posts.menu_order ASC, wp_posts.post_title ASC LIMIT 0, 12";
              }

              if ( $_GET['orderby'] == 'relevance' ) { // if orderby set to relevance
                $order_by_sql = "ORDER BY wp_posts.post_title LIKE '%".$search_query."%' DESC, wp_posts.post_date DESC LIMIT 0, 12";
              }

              if ( $_GET['orderby'] == 'popularity' ) { // if orderby set to popularity
                $order_by_sql = "ORDER BY wc_product_meta_lookup.total_sales DESC, wc_product_meta_lookup.product_id DESC LIMIT 0, 12";
              }

              if ( $_GET['orderby'] == 'rating' ) { // if orderby set to average rating
                $order_by_sql = "ORDER BY wc_product_meta_lookup.average_rating DESC, wc_product_meta_lookup.rating_count DESC, wc_product_meta_lookup.product_id DESC LIMIT 0, 12";
              }

              if ( $_GET['orderby'] == 'date' ) { // if orderby set to atest
                $order_by_sql = "ORDER BY wp_posts.post_date DESC, wp_posts.ID DESC LIMIT 0, 12";
              }

              if ( $_GET['orderby'] == 'price' ) { // if orderby set to price: low to high
                $order_by_sql = "ORDER BY wc_product_meta_lookup.min_price ASC, wc_product_meta_lookup.product_id ASC LIMIT 0, 12";
              }

              if ( $_GET['orderby'] == 'price-desc' ) { // if orderby set to price: high to low
                $order_by_sql = "ORDER BY wc_product_meta_lookup.max_price DESC, wc_product_meta_lookup.product_id DESC LIMIT 0, 12";
              }
            } 

            $input = "SELECT wp_posts.*
            FROM wp_posts
            JOIN $sitetran_pages sp
            ON sp.post_id = wp_posts.ID
            JOIN $sitetran_page_to_lang sptl
            ON sptl.page_id = sp.page_id 
            AND sptl.page_body LIKE CONCAT('%', '$search_query', '%')
            AND sptl.language_code = '$user_selected_lang'
            LEFT JOIN wp_wc_product_meta_lookup wc_product_meta_lookup 
            ON wp_posts.ID = wc_product_meta_lookup.product_id 
            WHERE (
              (wp_posts.post_type = 'post' AND (wp_posts.post_status = 'publish')) 
              OR (wp_posts.post_type = 'page' AND (wp_posts.post_status = 'publish')) 
              OR (wp_posts.post_type = 'attachment' AND (wp_posts.post_status = 'publish')) 
              OR (wp_posts.post_type = 'product' AND (wp_posts.post_status = 'publish'))
            ) 
            ".$order_by_sql."";

          }

        }
            
        remove_filter('posts_request','my_posts_request_filter');
      }

      return $input;
    }

    // When page loads this function is called
    function init() {
      $sitetran_authentication_key = get_option('sitetran_authentication_key');
      $sitetran_target_languages = json_decode( get_option('sitetran_target_languages') );

      // If sitetran site id is added in plugin settings
      if(!empty($sitetran_authentication_key) ) {
        add_action('wp_footer', array($this, 'SITETRAN_footer_language_switcher_callback'));
        add_filter('posts_request',array($this, 'SITETRAN_search_form_modify'));
      }

      // Register shortcode sitetran_widget
      add_shortcode('sitetran_widget', array($this, 'SITETRAN_language_switcher_shortcode') );

      // If sitetran_target_languages is saved in wp_options db table then only we are generating dynamic urls
      if( is_array($sitetran_target_languages) && !empty($sitetran_target_languages) ) {
        // We create virtual pages for each language codes
        // These are the endpoints that are available to users.
        add_action('init', array($this, 'SITETRAN_generate_rewrite_rules'));
        
        // We add hreflangs to the original language page if it has translated SEO.
        add_action('wp_head', array($this, 'SITETRAN_head_callback'));
      }

      add_filter('query_vars', array($this, 'SITETRAN_query_vars'));

      add_action('template_redirect', array($this, 'SITETRAN_template_redirect'));  
      
      add_action('init', array($this, 'SITETRAN_flush_rewrite_rules'));
    }


    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }
  }
  SITETRAN_frontend::instance();
}


// Filter wp_nav_menu() to add additional links and other output
// function new_nav_menu_items($items) {
  // $homelink = '<li><div id="sitetran_translate_element"></div></li>';
  // add the home link to the end of the menu
  // $items = $items . $homelink; // as a last item
  // $items = $homelink . $items; // as a first item
  // return $items;
// }
// add_filter( 'wp_nav_menu_items', 'new_nav_menu_items' );
//add_filter( 'wp_nav_menu_test-menu_items', 'new_nav_menu_items' );
//add_filter( 'wp_nav_menu_{$menu->slug}_items', 'new_nav_menu_items' );



// WE CAN USE "WP_FOOTER" ACTION TO ADD WIDGET IN THE FOOTER
// WE NEED TO WORRY ABOUT FOOTER ACTION SEQUENCE (PLACEMENT)
// IF SOMEBODY ADDS WIDGET IN FOOTER THEN WE CREATE A DIV AND WE PUT ON TOP OR BELOW THE FOOTER 
// add_action( 'wp_footer', array( $this, 'wp_footer_action' ), 19 );
// public function wp_footer_action() {
//   $rectangle = $this->settings->get_rectangle( 'statics', 'footer' );
//   if ( $rectangle->is_enabled() ) {
//     echo $this->render( $rectangle );
//   }
// }