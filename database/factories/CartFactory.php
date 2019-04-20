<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 19.04.2019
 */

use App\Modules\Categories\Models\Category;
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

$factory->define(App\Modules\Products\Models\Cart::class, function (Faker $faker) {
    return [
        'quantity' => random_int(1, 10),

        //parent_category_id can be provided in factory call
    ];
});