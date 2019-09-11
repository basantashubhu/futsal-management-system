<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Fgp\Volunteer::class, function (Faker $faker) {
    return [
        "salutation" => $faker->title,
        "first_name" => $faker->firstName,
        "middle_name" => '',
        "last_name" => $faker->lastName,
        "vol_supervisor_id" => random_int(1,5),
        "vol_ssn" => encrypt(random_int(100, 990)),
        "alt_id" => random_int(1000, 99999)
    ];
});

$factory->define(\App\Models\Fgp\VolunteerDetail::class, function(Faker $faker) {
    return [
        'volunteer_id' => random_int(1, 50),
        'label' => $faker->word,
        'code' => $faker->uuid,
        'value' => $faker->word
    ];
});

$factory->define(\App\Models\Fgp\Site::class, function(Faker $faker) {
    return [
      'site_name' => $faker->streetAddress,
      'site_email' => $faker->companyEmail
    ];
});

$factory->define(\App\Models\Contact::class, function(Faker $faker) {
    return [
      'table_name' => $faker->word,
      'table_id' => function(){
            return factory('App\Models\Fgp\Volunteer')->create()->id;
      },
      'tel_phone' => $faker->phoneNumber,
      'cell_phone' => $faker->phoneNumber,
      'email'   => $faker->unique()->safeEmail,
    ];
});

// $factory->define(\App\Models\VolunteerSite::class, function(Faker $faker)){
//   return [
    
//     'volunteer_id'=> random(1,10),
//     'site_id' => random(1,20),
    

//   ];

// });



