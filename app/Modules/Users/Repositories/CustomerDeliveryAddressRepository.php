<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.12.2017
 */

namespace App\Modules\Users\Repositories;

use App\Modules\Users\Models\CustomerDeliveryAddress;
use InfyOm\Generator\Common\BaseRepository;

class CustomerDeliveryAddressRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return CustomerDeliveryAddress::class;
    }

    public function save(CustomerDeliveryAddress $address): void
    {
        $address->save();
    }
}
