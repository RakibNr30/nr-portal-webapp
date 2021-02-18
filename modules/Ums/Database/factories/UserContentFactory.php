<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Ums\Entities\UserContent;

$factory->define(UserContent::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
		'description' => $faker->paragraph,
		'proficiency' => $faker->numberBetween(1, 5),
		'user_id' => $faker->numberBetween(1, 10),
    ];
});
