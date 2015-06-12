<?php namespace MoCCPosters\Controllers;

use MoCCPosters\Models\Mocclocation;
use Herbert\Framework\Models\PostMeta;

class StatsController {

    /**
     * Just return the number of visits with locations
     **/
    public function getVisitsWithLocation($id)
    {
        $locations = Mocclocation::where('postID', '=', $id)->get();

        return count($locations);

    }
    /**
     * Just return the number of visits.
     **/
    public function getVisits($id)
    {
        $count = PostMeta::where('post_id', '=', $id)->where('meta_key', '=', 'mocc_num_visits')->get();

        $count = $count[0]->meta_value;

        return empty($count) ? 0 : $count;

    }

    /**
     * Render all the stats at once.
     **/
    public function renderAllStats($id)
    {

        $count = PostMeta::where('post_id', '=', $id)->where('meta_key', '=', 'mocc_num_visits')->get();
        $locations = Mocclocation::where('postID', '=', $id)->get();

        return view('@MoCCPosters/stats.twig', [
            'locationsJSON' => $locations->toJson(),
            'locations'     => $locations,
            'visits'        => $count[0]->meta_value
        ]);

    }

    /**
     * Render all the stats at once.
     **/
    public function renderAllVisitorLocations($id)
    {
        $locations = Mocclocation::where('postID', '=', $id)->get();

        return view('@MoCCPosters/all-locations.twig', [
            'locationsJSON' => $locations->toJson(),
            'locations'     => $locations
        ]);
    }

    /**
     * Render all the stats at once.
     **/
    public function renderVisitorLocation(){
        return view('@MoCCPosters/your-location.twig');
    }

    /**
     * Show the post for the given id.
     **/
    public function clearStats($id)
    {

        $count = PostMeta::where('post_id', '=', $id)->where('meta_key', '=', 'mocc_num_visits')->get();
        $locations = Mocclocation::where('postID', '=', $id)->get();

        $msg =
            "Deleted ". count($locations) ." locations<br/>".
            "Reset count from ". $count[0]->meta_value;


        foreach($locations as $location){
            $location->delete();
        }

        foreach($count as $c){
            $c->delete();
        }

        return $msg;
    }
}
