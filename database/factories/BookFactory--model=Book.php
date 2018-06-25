<?php

use Faker\Generator as Faker;

$factory->define(\Modules\Book\Entities\Book::class, function (Faker $faker) {
    return [
        'name' => $faker->streetName,
        'quantity' => $faker->numberBetween($min = 10, $max = 100),
        'price' => $faker->numberBetween($min = 50000, $max = 100000),
        'image' => 'no-image.png',
        'description' => $faker->paragraph
    ];
});
