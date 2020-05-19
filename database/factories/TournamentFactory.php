<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Challonge;
use App\Tournament;
use Faker\Generator as Faker;

$factory->define(Tournament::class, function (Faker $faker) {
    return [
        'api' => '7UEFcBqaGuO5NecGTmabO2apOf3UmP1OYtHGF3fj',
        'nom' => $faker->company,
        'type' => $faker->randomElement(array_column(Challonge::TYPES, 'value')),
        'url' => 'https://challonge.com/tb78bfh8',
        'tournament' => 0,
        'game_id' => 0
    ];
});
