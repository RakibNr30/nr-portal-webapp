<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Cms\Entities\ImportantPerson;

$factory->define(ImportantPerson::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
		'designation' => $faker->word,
		'company' => $faker->word,
		'description' => $faker->paragraph,
		'external_link' => $faker->url,
    ];
});
