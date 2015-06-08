<?php namespace MoCCPosters\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Mocclocation extends Eloquent {
    protected $fillable = ['postID', 'latitude', 'longitude'];
    public $timestamps = false;
}
