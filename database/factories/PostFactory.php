<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Post;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    
    $title = $faker->sentence;
    
    return [
        'user_id' => factory(User::class),
        'title' => $title,
        'content' => $faker->sentence(4),
        'slug' => Str::slug($title, '-'),
        'activated' => rand(0, 1)
    ];
});
