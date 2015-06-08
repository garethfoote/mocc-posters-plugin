<?php

function add_location() {
    global $wp_query;

    // Check against nonce.
    $passes = check_ajax_referer( 'ajax-geolocation', 'security', false );
    // var_dump($passes);
    if($passes === false){
        die(-1);
    }

    $coords = $_POST['coords'];
    $pattern = '/^[+-]?\d+\.\d+$/';

    preg_match($pattern, $coords['lat'], $matches);
    if(count($matches) == 0){
        die(-1);
    }
    preg_match($pattern, $coords['lng'], $matches);
    if(count($matches) == 0){
        die(-1);
    }

    print_r($coords);
    die;
}

add_action('wp_ajax_add_location', 'add_location');
add_action('wp_ajax_nopriv_add_location', 'add_location');
