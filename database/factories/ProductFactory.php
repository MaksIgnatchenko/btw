<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 17.04.2019
 */

use App\Modules\Categories\Models\Category;
use App\Modules\Users\Merchant\Models\Store;
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

$factory->define(App\Modules\Products\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->words(rand(1,4), true),
        'attributes' => json_encode(['color' => [
            'type' => 'text',
            'value' => 'black'
        ]]),
        'quantity' => rand(50, 100),
        'price' => rand(10, 1000),
        'delivery_price' => rand(1, 50),
        'main_image' => 'no-image.png',
        'description' => $faker->text(200),
        'status' => 'active',
        //category_id and store_id need to be provided in factory call
    ];
});