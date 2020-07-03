<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ticket;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->sentence(4),
        'user_id' => factory(App\User::class),
        'slug' => Str::random(10),
        'status' => false
    ];
});
