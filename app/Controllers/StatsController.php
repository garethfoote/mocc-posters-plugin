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
            'locations' => $locations,
            'visits'    => $count[0]->meta_value
        ]);

    }

}
