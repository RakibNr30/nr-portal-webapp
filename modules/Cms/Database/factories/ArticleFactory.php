<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Cms\Entities\Article;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
		'description' => $faker->paragraph,
		'approve_status' => $faker->boolean,
		'approved_at' => $faker->dateTime,
		'approved_by' => $faker->numberBetween(1, 10),
		'article_category_id' => $faker->numberBetween(1, 10),
		'author_id' => $faker->numberBetween(1, 10),
    ];
});
