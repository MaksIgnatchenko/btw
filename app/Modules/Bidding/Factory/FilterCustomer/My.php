<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 31.01.2018
 */

namespace App\Modules\Bidding\Factories\FilterCustomer;

use App\Modules\Bidding\Dto\WishFilterDto;
use App\Modules\Bidding\Factories\AbstractFilterWishes;
use App\Modules\Bidding\Factories\FilterWishesInterface;
use App\Modules\Bidding\Models\Wish;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class My extends AbstractFilterWishes implements FilterWishesInterface
{
    /**
     * @param WishFilterDto $dto
     *
     * @return Collection
     */
    public function get(WishFilterDto $dto): Collection
    {
        $user = Auth::user();
        $customer = $user->customer;

        return $this->wishRepository->findByCustomerId($customer->id, $dto->getOffset(), Wish::PAGE_LIMIT);
    }
}
