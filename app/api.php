<?php namespace MoCCPosters;

/** @var \Herbert\Framework\API $api */

use MoCCPosters\Controllers\StatsController;


$api->add('getStats', function($id)
{
    if( empty($id) === true ){
        // Get current post id.
        $id = get_the_ID();
    }

    return (new StatsController)->showStats($id);

});
