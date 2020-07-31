<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'category_id' => $faker->randomDigitNot(0),
        'price_big' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 1, $max = 8),
        'price_small' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 1, $max = 5),
        'photo' => $faker->url
    ];
});
