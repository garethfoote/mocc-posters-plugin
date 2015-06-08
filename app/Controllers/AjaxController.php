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
            die('Security failed. Nonce not recognized');
        }

        if( $this->validateLocationData() === false ){
            die('Invalid coordinates');
        }

        if( isset($_SESSION['located'])  === true ){
            die('Already located');
        }

        if(($postID = intval($_POST['postID'])) === 0){
            die("Not valid post id");
        }

        $coords = $_POST['coords'];
        Mocclocation::create([
            'postID'   => $postID,
            'latitude'  => $coords['lat'],
            'longitude' => $coords['lng']
        ]);

        if( isset($_SESSION) !== true ){
            session_start();
        }

        $_SESSION['located'] = true;

        die("Successfully recorded location data");

    }

}
