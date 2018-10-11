<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 08.10.2018
 */

namespace App\Modules\Users\Customer\Repositories;

use App\Modules\Users\Customer\Models\Customer;
use InfyOm\Generator\Common\BaseRepository;

class CustomerRepository extends BaseRepository
{
    /**
     * Configure the Model.
     *
     * @return string
     */
    public function model(): string
    {
        return Customer::class;
    }
}