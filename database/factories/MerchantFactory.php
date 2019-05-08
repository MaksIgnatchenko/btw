<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 17.04.2019
 */

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

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

$factory->define(App\Modules\Users\Merchant\Models\Merchant::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => Hash::make('password'),
        'status' => 'active',
        'phone' => $faker->phoneNumber,
    ];
});