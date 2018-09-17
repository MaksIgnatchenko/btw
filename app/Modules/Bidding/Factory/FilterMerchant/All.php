<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 31.01.2018
 */

namespace App\Modules\Bidding\Factories\FilterMerchant;

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
     * @return Collection
     * @throws \App\Modules\Categories\Exceptions\NotFountCategory
     */
    public function get(WishFilterDto $dto): Collection
    {
        $user = Auth::user();
        $merchant = $user->merchant;
        /** @var Category $category */
        $category = app(Category::class);
        $categoryId = $dto->getCategoryId();
        $categoryIds = null;

        if (null !== $categoryId) {
            $categories = $category->getFinalCategories($categoryId);
            $categoryIds = $categories->pluck('id')->toArray();
        }

        return $this->wishRepository->findByConditionsForMerchant(
            $dto->getOffset(),
            Wish::PAGE_LIMIT,
            $merchant->id,
            $dto->getDistance(),
            $merchant->longitude,
            $merchant->latitude,
            $categoryIds,
            $dto->getName(),
            $dto->getBarcode()
        );
    }
}
