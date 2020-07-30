<?php

use App\Models\User;
use App\Models\News;
use App\Models\Comments;

use Faker\Generator as Faker;

$factory->define(Comments::class, function (Faker $faker) {

    $usersIds = User::get(['id'])->pluck('id')->all();
    $newsIds = News::get(['id'])->pluck('id')->all();
    $commentsIds = Comments::get(['id'])->pluck('id')->all();

    $faker->boolean(70) && $commentsIds ? $parentId = $faker->randomElement($commentsIds) : $parentId = null;


    echo count($commentsIds) . PHP_EOL;


    return [
        'body' => $faker->text,
        'user_id' => $faker->randomElement($usersIds),
        'news_id' => $faker->randomElement($newsIds),
        'parent_id' => $parentId
    ];
});
