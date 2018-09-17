<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */

use App\Modules\Rbac\Enum\RolesEnum;
use App\Modules\Rbac\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $owner = new Role();
        $owner->name = RolesEnum::MERCHANT;
        $owner->display_name = 'Merchant'; // optional
        $owner->description = 'Can sell items and take part in bids'; // optional
        $owner->save();

        $owner = new Role();
        $owner->name = RolesEnum::CUSTOMER;
        $owner->display_name = 'Customer'; // optional
        $owner->description = 'Can buy items and start bids'; // optional
        $owner->save();
    }
}
