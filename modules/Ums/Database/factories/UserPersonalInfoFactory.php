<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Ums\Entities\UserBasicInfo;

$factory->define(UserBasicInfo::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'designation' => $faker->sentence,
		'about' => $faker->paragraph,
		'phone_no' => $faker->phoneNumber,
		'mobile_no' => $faker->e164PhoneNumber,
		'fax_no' => $faker->phoneNumber,
		'personal_email' => $faker->safeEmail,
		'professional_email' => $faker->safeEmail,
		'website_url' => $faker->url,
		'dob' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
		'blood_group' => $faker->randomElement(['A+', 'B+', 'AB+', 'O+', 'O-']),
		'gender' => $faker->randomElement([1, 2]),
		'user_id' => $faker->numberBetween(1, 10),
    ];
});
