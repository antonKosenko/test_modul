<?php

use App\Models\User;
use App\Models\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    $usersIds = User::get(['id'])->pluck('id')->all();
    return [
        'title' => $faker->title,
        'body' => $faker->text,
        'user_id' => $faker->randomElement($usersIds),
    ];
});
