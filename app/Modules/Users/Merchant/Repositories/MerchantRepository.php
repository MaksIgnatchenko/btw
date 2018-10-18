<?php

namespace App\Modules\Users\Merchant\Repositories;

use App\Modules\Users\Merchant\Models\Merchant;
use InfyOm\Generator\Common\BaseRepository;

class MerchantRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return Merchant::class;
    }
}
