<?php namespace MoCCPosters;

/** @var \Herbert\Framework\API $api */

use MoCCPosters\Controllers\StatsController;


$api->add('getStats', function($id)
{
    // var_dump(empty($id));
    if( empty($id) === true ){
        // Get current post id.
        $id = get_the_ID();
        $id = 41;
    }

    return (new StatsController)->showStats($id);

});
