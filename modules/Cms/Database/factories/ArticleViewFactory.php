<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Cms\Entities\ArticleView;

$factory->define(ArticleView::class, function (Faker $faker) {
    return [
        'article_id' => $faker->word,
		'ip_address' => $faker->word,
		'mac_address' => $faker->word,
		'browser' => $faker->sentence,
		'latitude' => $faker->word,
		'longitude' => $faker->word,
    ];
});
