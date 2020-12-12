<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {

    return [
        'price' => $faker->randomDigitNotNull,
        'serial' => $faker->word,
        'delivery_price' => $faker->randomDigitNotNull,
        'total_price' => $faker->randomDigitNotNull,
        'process' => $faker->randomElement(['']),
        'deliveried_date' => $faker->word,
        'address_id' => $faker->randomDigitNotNull,
        'user_id' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
