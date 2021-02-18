<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Ums\Entities\UserEducationalInfo;

$factory->define(UserEducationalInfo::class, function (Faker $faker) {
    return [
        'institute_name' => $faker->company,
		'course_name' => $faker->word,
		'degree_name' => $faker->word,
		'description' => $faker->paragraph,
        'start_date' => \Carbon\Carbon::now(),
        'end_date' => \Carbon\Carbon::now(),
		'institute_website' => $faker->url,
		'institute_email' => $faker->companyEmail,
		'institute_phone' => $faker->phoneNumber,
		'user_id' => $faker->numberBetween(1, 10),
    ];
});
