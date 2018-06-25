<?php

use Faker\Generator as Faker;

$factory->define(\Modules\Genre\Entities\Genre::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->unique()->company,
        'description' => $faker->paragraph
    ];
});
