<?php namespace MoCCPosters\Controllers;

use MoCCPosters\Models\Mocclocation;
use Herbert\Framework\Models\PostMeta;

class StatsController {

    /**
     * Show the post for the given id.
     **/
    public function showStats($id)
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
