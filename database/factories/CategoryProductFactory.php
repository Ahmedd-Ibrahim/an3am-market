<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CategoryProduct;
use Faker\Generator as Faker;

$factory->define(CategoryProduct::class, function (Faker $faker) {

    return [
        'category_id' => $faker->randomDigitNotNull,
        'product_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
