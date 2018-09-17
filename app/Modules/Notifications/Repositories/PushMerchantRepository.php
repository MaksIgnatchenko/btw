<?php

namespace App\Modules\Notifications\Repositories;

use App\Modules\Notifications\Models\PushMerchant;
use InfyOm\Generator\Common\BaseRepository;

class PushMerchantRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return PushMerchant::class;
    }

    /**
     * @param PushMerchant $pushMerchant
     */
    public function save(PushMerchant $pushMerchant): void
    {
        $pushMerchant->save();
    }
}
