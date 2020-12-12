<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Settings;
use Faker\Generator as Faker;

$factory->define(Settings::class, function (Faker $faker) {

    return [
        'intro_ar_photo' => $faker->word,
        'intro_en_photo' => $faker->word,
        'intro_ar_title' => $faker->text,
        'intro_en_title' => $faker->text,
        'intro_ar_desc' => $faker->text,
        'intro_en_desc' => $faker->text,
        'about_ar' => $faker->word,
        'about_en' => $faker->word,
        'condation_ar' => $faker->word,
        'condation_en' => $faker->word,
        'privcy_ar' => $faker->word,
        'privcy_en' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
