<?php
//echo 'aa<br>';
//echo $slug.'<br>';
//echo $lang.'<br>';

// We checked to see if language code was in the url before getting to here in sitetran-front.php
// If slug doesn't exists then we know it's a homepage
// WE NEED TO REMOVE THIS AS WE DON'T NEED
if(!$slug) {
    // Homepage slug is '/' in db
    $sitetran_page_slug = '/';
} else {
    // Slug is missing '/' from the end, so we add it
    $sitetran_page_slug = $slug.'/';   //WE THOUGHT IT NEEDED SLASH AT THE END, DOESN'T SEEM TO. CHECK. 

    // If slug is not found, we need to return translated error pages.
}

// Getting sitetran_page_body from the db 
// global $wpdb;
// $tablename=$wpdb->prefix.'sitetran_seo';

// $cntSQL = "SELECT sitetran_page_body FROM {$tablename} WHERE sitetran_language_code = '$lang' AND sitetran_page_slug='$sitetran_page_slug'";
// $record = $wpdb->get_results($cntSQL, OBJECT);
// $totalrec = count($record);

// if ($totalrec == 1) {
//     $body = $record[0]->sitetran_page_body;
//     echo $body;
// }

// If the record was found for current page and translate = Y and seo = Y then here we return static translation else redirect to original url

if (!empty($record)) {
    if ($record[0]->translate_page == 'Y' && $record[0]->seo_page == 'Y') {
        // Outputs the exact HTML of the WP page translated to this language.
        if ( ! $record[0]->page_body || $record[0]->page_body == '' ) { // If page_body is empty redirect to original language page
            wp_redirect($page_url);
            exit;
        } else { // Send to translated page
            echo $record[0]->page_body;
        }
    } else {
        wp_redirect($page_url);
        exit;
    }
} else {
    wp_redirect($page_url);
    exit;
}

?>