<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 06.02.2018
 */

namespace App\Modules\Bidding\Repositories;

use App\Modules\Bidding\Models\DeclinedWish;
use InfyOm\Generator\Common\BaseRepository;

class DeclinedWishRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return DeclinedWish::class;
    }
}
