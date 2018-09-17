<?php

namespace App\Modules\Advert\Repositories;

use App\Modules\Advert\Models\AdvertConfig;
use InfyOm\Generator\Common\BaseRepository;

class AdvertConfigRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return AdvertConfig::class;
    }
}
