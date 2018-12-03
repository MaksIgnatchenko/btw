<?php

use Illuminate\Database\Seeder;

class CartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = \App\Modules\Products\Models\Product::all()->toArray();
        $customers = \App\Modules\Users\Customer\Models\Customer::all()->toArray();

        for ($i = 0; $i < 20; $i++) {
            $product = $products[random_int(0, count($products) - 1)];
            $customer = $customers[random_int(0, count($customers) - 1)];

            \App\Modules\Products\Models\Cart::create([
                'quantity' => random_int(1, $product['quantity']),
                'customer_id' => $customer['id'],
                'product_id' => $product['id'],
            ]);
        }


    }
}
