<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    $name = $faker->streetName();
    $desc = "Prelepa soba " . $name . " v hotelu Outercontinental";
    return [
        'name'=>$name,
        'price_per_night'=>$faker->numberBetween($min = 30, $max = 200),
        'short_description'=> $desc,
        'long_description'=> $desc . ". Podrobnosti o tej sobi: " . $faker->text( $maxNbChars = 100),
    ];
});
