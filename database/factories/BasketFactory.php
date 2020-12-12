<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Basket;
use Faker\Generator as Faker;

$factory->define(Basket::class, function (Faker $faker) {

    return [
        'product_id' => $faker->randomDigitNotNull,
        'user_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
