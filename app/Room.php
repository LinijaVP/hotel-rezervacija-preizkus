<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        "name",
        "price_per_night",
        "short_description",
        "long_description",
    ];   
}
