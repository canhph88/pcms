<?php

use Faker\Generator as Faker;

$factory->define(\Modules\Author\Entities\Author::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'fullName' => $faker->name,
        'birthday' => $faker->dateTimeBetween($startDate = '-70 years', $endDate = '-18 years'),
        'hometown' => $faker->city,
        'country' => $faker->country,
    ];
});
