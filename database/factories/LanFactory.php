<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Lan;
use App\User;
use Faker\Generator as Faker;

function roundToQuarterHour(DateTime $dateTime) {
    return $dateTime->setTime(
        $dateTime->format('H'),
        round((int)$dateTime->format('i') / 15) * 15,
        0
    );
}

$factory->define(Lan::class, function (Faker $faker) {
    return [
        'nom' => $faker->catchPhrase,
        'info' => $faker->text,
        'max' => $faker->numberBetween(1, 256),
        'date' => roundToQuarterHour($faker->dateTime),
        'user_id' => User::all()->random()
    ];
});
