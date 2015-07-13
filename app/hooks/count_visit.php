<?php

use MoCCPosters\Helper;

if( isset($_SESSION) !== true ){
    session_start();
}

function mocc_count_visit(){
    global $post;

    if(is_admin()){
        return;
    }

    if($post->post_type !== 'poster'){
        return;
    }

    /*
    if( $_SESSION['counted'] === true ){
        return;
    }
     */

    $count = get_post_meta( $post->ID, 'mocc_num_visits', true );
    if( empty($count) === true ){
        add_post_meta( $post->ID, 'mocc_num_visits', 1, true );
    } else {
        update_post_meta( $post->ID, 'mocc_num_visits', ($count+1) );
    }

    // $_SESSION['counted'] = true;

     echo "<script>console.debug('Recorded visit : ".$count."');</script>";

}

add_action('shutdown', 'mocc_count_visit', 11);
