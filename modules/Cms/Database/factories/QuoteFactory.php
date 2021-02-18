<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Cms\Entities\Quote;

$factory->define(Quote::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
		'designation' => $faker->word,
		'message' => $faker->paragraph,
    ];
});
