<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderedItems;
use Faker\Generator as Faker;

$factory->define(OrderedItems::class, function (Faker $faker) {
    return [
        'order_id' => function () {
            return factory(\App\Order::class)->create()->id;
        },
        'product_id' =>  function () {
            return factory(\App\Product::class)->create()->id;
        },
        'quantity' => $faker->randomDigitNot(0),
        'price' => $faker->randomDigitNot(0)
    ];
});
