<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductOrder;
use Faker\Generator as Faker;

$factory->define(ProductOrder::class, function (Faker $faker) {

    return [
        'product_id' => $faker->randomDigitNotNull,
        'order_id' => $faker->randomDigitNotNull,
        'count' => $faker->randomDigitNotNull,
        'price' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
