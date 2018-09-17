<?php

use App\Modules\Advert\Models\AdvertConfig;
use Illuminate\Database\Seeder;

/**
 * Created by Artem Petrov, Appus Studio LP on 20.11.2017
 */
class AdvertConfigTableSeeder extends Seeder
{
    public function run()
    {
        $category1 = new AdvertConfig();
        $category1->key = 'mode';
        $category1->value = 'admob';
        $category1->save();
    }
}
