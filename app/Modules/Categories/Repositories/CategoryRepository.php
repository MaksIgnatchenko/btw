<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */

namespace App\Modules\Categories\Repositories;

use App\Helpers\PreparedStatementsHelper;
use App\Modules\Categories\Models\Category;
use App\Modules\Users\Models\CustomerDeliveryAddress;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

class CategoryRepository extends BaseRepository
{
    /**
     * @param int $parentId
     *
     * @return Collection
     */
    public function findChildCategories(int $parentId): Collection
    {
        return Category::where(['parent_category_id' => $parentId])->get();
    }

    public function findById(int $id): Collection
    {
        return Category::where(['id' => $id])->get();
    }

    /**
     * @return Collection
     */
    public function findRootCategories(): Collection
    {
        return Category::whereNull('parent_category_id')->get();
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Category::class;
    }
}
