<?php

use MoCCPosters\Helper;

$container->enqueue->front([
    'as'     => 'locationJS',
    'src'    => Helper::assetUrl('/scripts/geolocate.js'),
    'filter' => [ 'postType' => 'poster' ]
], 'footer');


function mocc_add_script() {

    if(is_admin()){
        return;
    }

    if(get_post_type() !== 'poster'){
        return;
    }

    $ajaxUrl = admin_url('admin-ajax.php');
    $ajaxNonce = wp_create_nonce( "ajax-geolocation" );
    $jqueryUrl = Helper::assetUrl('/vendor/jquery.min.js');
    $postID = get_the_ID();

    $script = <<<JS
<script>
    window.ajaxURL = "$ajaxUrl";
    window.ajaxNonce = "$ajaxNonce";
    window.postID = "$postID";
    if(typeof jQuery=='undefined'){
        document.write( '<script src="$jqueryUrl"><\/script>' );
    }
    $ = jQuery;
</script>
JS;

    echo $script;

}

add_action('get_footer', 'mocc_add_script');

function mocc_render_stats(){
    $html = <<<HTML
<div class="moccStats">

    <div class="moccStats-count">
        <h3>Visits</h3>
    </div>

    <div class="moccStats-locations"></div>
        <h3>Visits with location</h3>
    </div>

    <div class="moccStats-yourLocation"></div>
        <h3>Your location</h3>
        <div class="js-moccStats-locationImg"></div>
    </div>

</div>

HTML;

    echo $html;

}
add_action('mocc_stats', 'mocc_render_stats', 11);

