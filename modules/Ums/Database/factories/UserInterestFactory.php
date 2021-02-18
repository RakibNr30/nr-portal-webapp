<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Ums\Entities\UserInterest;

$factory->define(UserInterest::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
		'description' => $faker->paragraph,
		'user_id' => $faker->numberBetween(1, 10),
    ];
});
