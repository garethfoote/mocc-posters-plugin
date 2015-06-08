<?php namespace MoCCPosters\Controllers;

use MoCCPosters\Models\Mocclocation;

class StatsController {

    /**
     * Show the post for the given id.
     **/
    public function showStats($id)
    {

        $locations = Mocclocation::where('postID', '=', $id)->get();

        return view('@MoCCPosters/stats.twig', ['locations' => $locations]);

    }

}
