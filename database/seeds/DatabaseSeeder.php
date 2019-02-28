<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(ContentTableSeed::class);
        $this->call(MerchantTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductTableSeeder::class);
      //  $this->call(CartTableSeeder::class);
       // $this->call(OrderTableSeeder::class);
       // $this->call(TransactionTableSeeder::class);
    }
}
