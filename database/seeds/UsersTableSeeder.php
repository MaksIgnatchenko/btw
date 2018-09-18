<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */

use App\Modules\Rbac\Enum\RolesEnum;
use App\Modules\Users\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            'username' => 'admin',
            'email' => 'admin@wish.com',
            'password' => Hash::make('admin'),
            'remember_token' => str_random(10),
        ]);
    }
}
