<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $categorieIds = range(1,12);

        for ($i = 1; $i <= 20; $i++) {
            DB::table('products')->insert([
                'name' => 'Test Product #' . $i,
                'description' => 'Test Product #' . $i . ' Desc',
                'price' => mt_rand(100, 2000) + mt_rand(0, 99) / 100,
                'quantity' => mt_rand(1, 50),
                'category_id' => $categorieIds[mt_rand(0, count($categorieIds) - 1)],
                'main_image' => 'demo.jpeg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'attributes' => '{"test" : {"type" : "text" , "value" : "test"}}',
                'store_id' => 1,
            ]);
        }
    }
}
