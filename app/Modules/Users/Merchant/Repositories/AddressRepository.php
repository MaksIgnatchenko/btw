<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 16.10.2018
 */

namespace App\Modules\Users\Repositories;

use App\Modules\Users\Merchant\Models\Address;
use InfyOm\Generator\Common\BaseRepository;

class AddressRepository extends BaseRepository
{
    public function model()
    {
        return Address::class;
    }

    public function save(Address $address)
    {
        $address->save();
    }

    public function getByMerchantId($id)
    {
        return Address::where('merchant_id', $id)->first();
    }
}
