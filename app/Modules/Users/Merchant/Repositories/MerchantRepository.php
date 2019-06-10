<?php

namespace App\Modules\Users\Merchant\Repositories;

use App\Modules\Users\Merchant\Models\Geography\GeographyCity;
use App\Modules\Users\Merchant\Models\Geography\GeographyCountry;
use App\Modules\Users\Merchant\Models\Geography\GeographyState;
use App\Modules\Users\Merchant\Models\Merchant;
use InfyOm\Generator\Common\BaseRepository;

class MerchantRepository extends BaseRepository
{
    /**
     * Configure the Model
     *
     * @return string
     */
    public function model(): string
    {
        return Merchant::class;
    }

    public function getAllCount() : int
    {
        return $this->model()::count();
    }
}
