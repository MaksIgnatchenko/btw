<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = \App\Modules\Products\Models\Transaction::all();
        foreach ($transactions as $transaction) {
            $carts = json_decode($transaction->cart);

            foreach ($carts as $cart) {
                \App\Modules\Orders\Models\Order::create([
                    'customer_id' => $cart->customer_id,
                    'merchant_id' => \App\Modules\Products\Models\Product::find($cart->product_id)->store->merchant_id,
                    'transaction_id' => $transaction->id,
                    'product' => \App\Modules\Products\Models\Product::find($cart->product_id),
                    'quantity' => $cart->quantity,
                    'status' => \App\Modules\Orders\Enums\OrderStatusEnum::PENDING,
                ]);
            }
        }
    }
}
