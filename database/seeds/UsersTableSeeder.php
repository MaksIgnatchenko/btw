<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */

use App\Modules\Rbac\Enum\RolesEnum;
use App\Modules\Users\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'customer1',
            'email'    => 'customer@pitch.com',
            'password' => Hash::make('customer1!'),
        ]);

        DB::table('users')->insert([
            'username' => 'merchant1',
            'email'    => 'merchant@pitch.com',
            'password' => Hash::make('merchant'),
        ]);

        $user = User::find(1);
        $user->attachRole(RolesEnum::CUSTOMER);

        $user = User::find(2);
        $user->attachRole(RolesEnum::MERCHANT);


        DB::table('admins')->insert([
            'username'       => 'administrator',
            'password'       => Hash::make('administrator'),
            'remember_token' => str_random(10),
        ]);
    }
}
