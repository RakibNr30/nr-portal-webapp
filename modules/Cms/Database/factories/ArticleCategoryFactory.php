<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Cms\Entities\ArticleCategory;

$factory->define(ArticleCategory::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
		'description' => $faker->paragraph,
    ];
});
