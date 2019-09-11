<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Settings\ZipCode::class, function (Faker $faker) {
    return [
    	'zip_code' =>	$faker->postcode,
        'city' => $faker->city,
        'county'=> $faker->cityPrefix,
        'state'=>	$faker->state,
        'district' => $faker->word,

    ];
});
