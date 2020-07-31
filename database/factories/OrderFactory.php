<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomDigit,
        'status' => $faker->numberBetween($min = 0, $max = 2),
        'address' => $faker->address,
        'phone' => $faker->numberBetween($min = 860000000, $max = 869999999),
        'end_time' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+15 minutes', $timezone = 'Europe/Vilnius')
    ];
});
