<?php namespace MoCCPosters\Controllers;

use MoCCPosters\Models\Mocclocation;

class AjaxController {

    /**
     * Check ajax nonce.
     **/
    private function checkNonce($id)
    {
       return check_ajax_referer( 'ajax-geolocation', 'security', false );
    }

    /**
     * Validate we have appropriate data for latitude and longitude.
     **/
    private function validateLocationData($id)
    {
        $coords = $_POST['coords'];
        $pattern = '/^[+-]?\d+\.\d+$/';

        preg_match($pattern, $coords['lat'], $matches);
        if(count($matches) == 0){
            return false;
        }
        preg_match($pattern, $coords['lng'], $matches);
        if(count($matches) == 0){
            return false;
        }

        return true;
    }

    /**
     * Show the post for the given id.
     **/
    public function saveLocation($id)
    {
        if( $this->checkNonce() === false ){
            // die();
            echo "Failed nonce";
        }

        if( $this->validateLocationData() === false ){
            die();
        }

        if(($postID = intval($_POST['postID'])) === 0){
            echo "failed post id";
            die();
        }

        $coords = $_POST['coords'];
        Mocclocation::create([
            'postID'   => $postID,
            'latitude'  => $coords['lat'],
            'longitude' => $coords['lng']
        ]);

        echo "Yeah!!!!";

        // return view('@MyPlugin/post/single.twig', ['post' => $post]);
    }

}
