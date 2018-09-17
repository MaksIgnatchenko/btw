<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.12.2017
 */

namespace App\Modules\Users\Repositories;

use App\Modules\Users\Models\CustomerAddress;
use InfyOm\Generator\Common\BaseRepository;

class CustomerAddressRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return CustomerAddress::class;
    }

    public function save(CustomerAddress $address): void
    {
        $address->save();
    }
}
