<?php

use MoCCPosters\Helper;

if( isset($_SESSION) !== true ){
    session_start();
}

function mocc_count_visit(){
    global $post;

    if( $_SESSION['counted'] === true ){
        return;
    }

    $count = get_post_meta( $post->ID, 'mocc_num_visits', true );
    if( empty($count) === true ){
        add_post_meta( $post->ID, 'mocc_num_visits', 1, true );
    } else {
        update_post_meta( $post->ID, 'mocc_num_visits', ($count+1) );
    }

    $_SESSION['counted'] = true;

}

add_action('get_header', 'mocc_count_visit', 11);
