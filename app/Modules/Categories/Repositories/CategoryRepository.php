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

    /**
     * Return delivery addresses with needed customers and users
     *
     * @param $categoryId
     * @param $longitude
     * @param $latitude
     * @param $radius
     *
     * @return Collection
     */
    public function findCustomersInRadius($categoryId, $longitude, $latitude, $radius): Collection
    {
        $sql = PreparedStatementsHelper::getDistanceSql($latitude, $longitude);

        $customerIds = Category::find($categoryId)->pushCustomers->pluck('customer_id');

        $deliveryAddress = CustomerDeliveryAddress::whereIn('customer_id', $customerIds)
            ->selectRaw("{$sql} AS distance, customer_id, longitude, latitude")
            ->whereRaw("{$sql} < ?", [$radius])
            ->with('customer')
            ->get();

        return $deliveryAddress;
    }
}
