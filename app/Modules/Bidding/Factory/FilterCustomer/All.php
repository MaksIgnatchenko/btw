<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 31.01.2018
 */

namespace App\Modules\Bidding\Factories\FilterCustomer;

use App\Modules\Bidding\Dto\WishFilterDto;
use App\Modules\Bidding\Factories\AbstractFilterWishes;
use App\Modules\Bidding\Factories\FilterWishesInterface;
use App\Modules\Bidding\Models\Wish;
use App\Modules\Categories\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class All extends AbstractFilterWishes implements FilterWishesInterface
{
    /**
     * @param WishFilterDto $dto
     *
     * @return Collection[Wish]
     * @throws \App\Modules\Categories\Exceptions\NotFountCategory
     */
    public function get(WishFilterDto $dto): Collection
    {
        $user = Auth::user();
        $customer = $user->customer;
        /** @var Category $category */
        $category = app(Category::class);
        $categoryId = $dto->getCategoryId();
        $categoryIds = null;

        if (null !== $categoryId) {
            $categoryIds = $category->getFinalCategories($categoryId)
                ->pluck('id')
                ->toArray();
        }

        return $this->wishRepository->findByConditions(
            $dto->getOffset(),
            Wish::PAGE_LIMIT,
            $customer->id,
            $dto->getDistance(),
            $dto->getLongitude(),
            $dto->getLatitude(),
            $categoryIds,
            $dto->getName(),
            $dto->getBarcode()
        );
    }
}
