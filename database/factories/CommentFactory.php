<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    $film = factory(App\Film::class)->create();
    $genre = factory(App\Genre::class)->create();
    $film->genres()->attach($genre->id);
    return [
        'film_id' => $film->id,
        'user_id' => factory(App\User::class)->create()->id,
        'comment' => $faker->paragraph,
    ];
});
