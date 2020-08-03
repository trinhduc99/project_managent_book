<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'name_author' => $faker->name,
        'category_id' => $faker->numberBetween(1, 30),
        'image_path' => $faker->imageUrl($width = 640, $height = 480),
        'image_name' => $faker->imageUrl($width = 640, $height = 480),
        'user_id' => 3,
        'content' => $faker->text($maxNbChars = 30),
        'created_at' => new DateTime(),
        'updated_at' => new DateTime()
    ];
});
