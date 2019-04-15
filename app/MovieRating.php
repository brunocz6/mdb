<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieRating extends Model
{
    // Název tabulky
    protected $table = 'movie_ratings';

    // Id záznamu
    public $primaryKey = 'id';

    // Timestamps
    public $timestampts = true;

    function movie(){
        return $this->belongsTo('App\Movie');
    }

    function author(){
        return User::where('id',$this->user_id)->first();
        // return $this->belongsTo('App\User');
    }
}