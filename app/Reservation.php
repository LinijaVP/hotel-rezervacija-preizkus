<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        "name",
        "email",
        "telephone",
        "room_id",
        "arrival_date",
        "departure_date",
        "extras",
    ];   
}
