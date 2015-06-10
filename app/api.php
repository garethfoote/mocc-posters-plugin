<?php namespace MoCCPosters;

/** @var \Herbert\Framework\API $api */

use MoCCPosters\Controllers\StatsController;


$api->add('renderAllStats', function($id)
{
    if( empty($id) === true ){
        // Get current post id.
        $id = get_the_ID();
    }

    return (new StatsController)->renderAllStats($id);

});

$api->add('getVisits', function($id)
{
    if( empty($id) === true ){
        // Get current post id.
        $id = get_the_ID();
    }

    return (new StatsController)->getVisits($id);

});

$api->add('getVisitsWithLocation', function($id)
{
    if( empty($id) === true ){
        // Get current post id.
        $id = get_the_ID();
    }

    return (new StatsController)->getVisitsWithLocation($id);

});

$api->add('renderVisitorLocation', function($id)
{
    return (new StatsController)->renderVisitorLocation();

});

$api->add('renderAllVisitorLocations', function($id)
{
    if( empty($id) === true ){
        // Get current post id.
        $id = get_the_ID();
    }

    return (new StatsController)->renderAllVisitorLocations($id);

});
