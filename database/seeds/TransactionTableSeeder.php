<?php

use Illuminate\Database\Seeder;

class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = \App\Modules\Users\Customer\Models\Customer::all()->toArray();
        $customerIds = \App\Modules\Users\Customer\Models\Customer::all()->pluck('id')->toArray();

        $usedCustomerIds = [];

        while (!empty(array_diff($customerIds, $usedCustomerIds))) {
            $customer = $customers[random_int(0, count($customers) - 1)];

            if (!in_array($customer['id'], $usedCustomerIds)) {
                $usedCustomerIds[] = $customer['id'];

                \App\Modules\Products\Models\Transaction::create([
                    'customer_id' => $customer['id'],
                    'cart' => \App\Modules\Products\Models\Cart::where('customer_id', $customer['id'])->get(),
                    'message' => 'Proceed',
                    'status' => 'success',
                    'amount' => mt_rand(100, 2000) + mt_rand(0, 99) / 100,
                ]);
            }
        }


    }
}
