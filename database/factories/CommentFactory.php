<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'ticket_id' => factory(App\Ticket::class),
        'user_id' => factory(App\User::class),        
        'content' => $faker->sentence(4),
        'status' => false
    ];
});
