<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Ums\Entities\UserWorkInfo;

$factory->define(UserWorkInfo::class, function (Faker $faker) {
    return [
        'company_name' => $faker->company,
		'company_website' => $faker->url,
		'company_email' => $faker->companyEmail,
		'company_phone' => $faker->phoneNumber,
		'company_address' => $faker->address,
		'department' => $faker->word,
		'designation' => $faker->word,
        'start_date' => \Carbon\Carbon::now(),
        'end_date' => \Carbon\Carbon::now(),
		'description' => $faker->paragraph,
        'user_id' => $faker->numberBetween(1, 10),
    ];
});
