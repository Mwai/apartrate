<?php

use Faker\Generator as Faker;

$factory->define(App\Film::class, function (Faker $faker) {
    $name = $faker->name;

    return [
        'name'         => $name,
        'slug'         => str_slug($name),
        'description'  => $faker->paragraph,
        'release_date' => date('Y-m-d', strtotime('+' . mt_rand(0, 30) . ' days')),
        'rating'       => rand(1, 5),
        'ticket_price' => rand(1000, 5000),
        'country'      => $faker->name,
        'photo'        => '/img/film.jpg',
    ];
});
