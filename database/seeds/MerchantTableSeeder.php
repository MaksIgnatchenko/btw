<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 17.10.2018
 */

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Modules\Users\Merchant\Models\Merchant;
use App\Modules\Users\Merchant\Models\Address;
use App\Modules\Users\Merchant\Models\Store;
use App\Modules\Categories\Models\Category;

class MerchantTableSeeder extends Seeder
{
    public function run(): void
    {
        $merchant = Merchant::create([
            'first_name' => 'Appus Merchant',
            'last_name' => 'Tester',
            'email' => 'merchant@wish.com',
            'password' => Hash::make('Qwerty1221!')
        ]);

        Address::create([
            'country' => 'UA',
            'state' => 'Florida',
            'city' => 'Miami',
            'street' => '86 Marshall Drive Bluffton',
            'zipcode' => 'SC 29910',
            'merchant_id' => $merchant->id,
        ]);

        $store = Store::create([
            'name' => 'Appus',
            'country' => 'UA',
            'city' => 'Kharkov',
            'info' => 'Some long text description',
            'merchant_id' => $merchant->id,
        ]);

        $category = Category::create([
            'name' => 'Development',
            'parent_category_id' => null,
            'is_final' => true,
            'icon' => null,
            'attributes' => null,
        ]);

        $store->categories()->attach([$category->id]);
    }
}