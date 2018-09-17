<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.01.2018
 */

namespace App\Modules\Bidding\Factories;

use App\Modules\Bidding\Dto\WishFilterDto;
use Illuminate\Support\Collection;

interface FilterWishesInterface
{
    /**
     * @param WishFilterDto $dto
     *
     * @return Collection
     */
    public function get(WishFilterDto $dto): Collection;
}
