<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Ums\Entities\Module;

$factory->define(Module::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
		'description' => $faker->paragraph,
    ];
});
