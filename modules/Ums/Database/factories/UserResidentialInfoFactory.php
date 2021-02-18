<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Ums\Entities\UserResidentialInfo;

$factory->define(UserResidentialInfo::class, function (Faker $faker) {
    return [
        'present_country' => $faker->country,
		'present_city' => $faker->city,
		'present_state' => $faker->state,
		'present_address_line_1' => $faker->address,
		'present_address_line_2' => null,
		'permanent_country' => $faker->country,
		'permanent_city' => $faker->city,
		'permanent_state' => $faker->state,
		'permanent_address_line_1' => $faker->address,
		'permanent_address_line_2' => null,
		'google_map_url' => $faker->url,
		'longitude' => $faker->longitude,
		'latitude' => $faker->latitude,
		'user_id' => $faker->numberBetween(1, 10),
    ];
});
