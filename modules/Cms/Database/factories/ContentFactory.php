<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Cms\Entities\Content;

$factory->define(Content::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
		'slug' => $faker->slug,
		'description' => $faker->paragraph,
		'tags' => $faker->sentence,
		'content_category_id' => $faker->numberBetween(1, 10),
		'display_date' => $faker->dateTime,
		'created_by' => $faker->numberBetween(1, 10),
    ];
});
