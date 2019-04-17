<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 17.04.2019
 */

use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

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
/**
 * @var Faker $factory
 */
$factory->define(App\Modules\Users\Merchant\Models\Store::class, function (Faker $faker) {
    return [
        'name' => $faker->words(rand(2,5), true),
        'country' => 'en',
        'city' => $faker->city,
        'info' => $faker->text,
        //merchant_id need to be provided in factory call
    ];
});