<?php

use MoCCPosters\Helper;

$container->enqueue->front([
    'as'     => 'locationJS',
    'src'    => Helper::assetUrl('/scripts/geolocate.js'),
    'filter' => [ 'postType' => 'poster' ]
], 'footer');

$container->enqueue->front([
    'as'     => 'leafletJS',
    'src'    => Helper::assetUrl('/vendor/leaflet/leaflet.js'),
    'filter' => [ 'postType' => 'poster' ]
], 'footer');

$container->enqueue->front([
    'as'     => 'leafletCSS',
    'src'    => Helper::assetUrl('/vendor/leaflet/leaflet.css'),
    'filter' => [ 'postType' => 'poster' ]
], 'footer');

$container->enqueue->front([
    'as'     => 'leafletClusterJS',
    'src'    => Helper::assetUrl('/vendor/leaflet/leaflet.markercluster.js'),
    'filter' => [ 'postType' => 'poster' ]
], 'footer');

$container->enqueue->front([
    'as'     => 'moccPostersCSS',
    'src'    => Helper::assetUrl('/styles/mocc-posters.css'),
    'filter' => [ 'postType' => 'poster' ]
], 'footer');

$container->enqueue->front([
    'as'     => 'mapJS',
    'src'    => Helper::assetUrl('/scripts/map.js'),
    'filter' => [ 'postType' => 'poster' ]
], 'footer');

function mocc_add_script() {

    if(is_admin()){
        return;
    }

    if(get_post_type() !== 'poster'){
        return;
    }

    $ajaxURL = rtrim(home_url(), '/') . '/mocc-save-location';
    $ajaxNonce = wp_create_nonce( "ajax-geolocation" );
    $located = (isset($_SESSION['located']) === true) ? 'true' : 'false';
    $postID = get_the_ID();
    $assetURL = Helper::assetUrl('/');
    $jqueryURL = Helper::assetUrl('/vendor/jquery.min.js');

    $script = <<<JS
<script>
    window.MoCCPosters = {};
    window.MoCCPosters.assetURL = "$assetURL";
    window.MoCCPosters.ajaxNonce = "$ajaxNonce";
    window.MoCCPosters.ajaxURL = "$ajaxURL";
    window.MoCCPosters.located = $located;
    window.MoCCPosters.postID = "$postID";

    if(typeof jQuery=='undefined'){
        document.write( '<script src="$jqueryURL"><\/script>' );
    }
    $ = jQuery;
</script>
JS;

    echo $script;

}

add_action('get_footer', 'mocc_add_script');
