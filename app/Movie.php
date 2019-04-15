<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    // Název tabulky
    protected $table = 'movies';

    // Id záznamu
    public $primaryKey = 'id';

    // Timestamps
    public $timestampts = true;

    function movieRatings(){
        return $this->hasMany('App\MovieRating');
    }

    function category(){
        return $this->belongsTo('App\MovieCategory');
    }

    function averageRating(){
        return count($this->movieRatings) > 0 ? ($this->movieRatings->sum('stars'))/(count($this->movieRatings)) : 0;
    }
}
