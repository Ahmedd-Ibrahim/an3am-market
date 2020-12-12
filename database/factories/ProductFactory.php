<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    return [
        'name' => $faker->text,
        'desc' => $faker->text,
        'sale_price' => $faker->randomDigitNotNull,
        'featuter' => $faker->randomElement(['true', 'false']),
        'stock' => $faker->randomDigitNotNull,
        'regular_price' => $faker->randomDigitNotNull,
        'user_id' => $faker->randomDigitNotNull,
        'type_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
