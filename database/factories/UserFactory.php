<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'role_id' => function(){
            return factory('App\Models\Role')->create()->id;
        },
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

// $factory->define(\App\Models\Fgp\Volunteer::class, function (Faker $faker) {
//     return [
//     	'salutation' => $faker->title,
//         'first_name' => $faker->firstName,
//         'last_name' => $faker->lastName,
//         // 'email' => $faker->unique()->safeEmail,
//     ];
// });

$factory->define(App\Models\Role::class, function(Faker $faker){
    return [
        'name' => $faker->word,
        'label' => $faker->word
    ];

});
