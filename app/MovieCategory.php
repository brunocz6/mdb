<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieCategory extends Model
{
    // Název tabulky
    protected $table = 'movie_categories';

    // Id záznamu
    public $primaryKey = 'id';

    // Timestamps
    public $timestampts = true;

    function movies(){
        return $this->hasMany('App\Movie', 'category_id', 'id');
    }
}
