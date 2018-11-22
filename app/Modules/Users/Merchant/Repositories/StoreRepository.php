<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 14.11.2018
 */

namespace App\Modules\Users\Merchant\Repositories;

use App\Modules\Users\Merchant\Models\Store;
use InfyOm\Generator\Common\BaseRepository;

class StoreRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Store::class;
    }

    /**
     * @param Store $address
     *
     * @return bool
     */
    public function save(Store $address): bool
    {
        return $address->save();
    }
}
