<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 16.10.2018
 */

namespace App\Modules\Users\Repositories;

use App\Modules\Users\Merchant\Models\Address;
use InfyOm\Generator\Common\BaseRepository;

class AddressRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Address::class;
    }

    /**
     * @param Address $address
     *
     * @return bool
     */
    public function save(Address $address): bool
    {
        return $address->save();
    }

    /**
     * @param int $id
     *
     * @return Address|null
     */
    public function getByMerchantId(int $id): ?Address
    {
        return Address::where('merchant_id', $id)->first();
    }
}
