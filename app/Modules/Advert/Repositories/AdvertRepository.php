<?php

namespace App\Modules\Advert\Repositories;

use App\Modules\Advert\Models\Advert;
use InfyOm\Generator\Common\BaseRepository;

class AdvertRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return Advert::class;
    }

    /**
     * @param Advert $advert
     */
    public function save(Advert $advert): void
    {
        $advert->save();
    }
}
