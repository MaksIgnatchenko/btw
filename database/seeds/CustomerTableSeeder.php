<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('customers')->insert([
            'first_name' => 'Appus',
            'last_name' => 'Tester',
            'email' => 'customer@wish.com',
            'address' => '86 Marshall Drive Bluffton, SC 29910',
            'password' => Hash::make('Qweqwe1!'),
        ]);
    }
}
