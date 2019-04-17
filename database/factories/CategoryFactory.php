<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 17.04.2019
 */

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

$factory->define(App\Modules\Categories\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->words(rand(1,4), true),
        'is_final' => 0,
        'icon' => 'no-icon.png',
        'attributes' => json_encode(['color' => [
            'type' => 'text',
            'value' => 'black'
        ]]),
        //parent_category_id can be provided in factory call
    ];
});