<?php

namespace App\Modules\Bidding\Repositories;

use App\Helpers\PreparedStatementsHelper;
use App\Modules\Bidding\Models\Wish;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use InfyOm\Generator\Common\BaseRepository;

class WishRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return Wish::class;
    }

    /**
     * @param Wish $wish
     */
    public function save(Wish $wish): void
    {
        $wish->save();
    }

    // TODO refactor it

    /**
     * @param int $customerId
     * @param int $limit
     * @param int $offset
     *
     * @return Collection
     */
    public function findByCustomerId(int $customerId, int $offset, int $limit): Collection
    {
        return Wish::active()
            ->where('customer_id', $customerId)
            ->withoutUnused()
            ->bidCount()
            ->with('lowestBid')
            ->offset($offset)
            ->limit($limit)
            ->get();
    }

    /**
     * @param int $offset
     * @param int $limit
     * @param int $customerId
     * @param int $distance
     * @param float $longitude
     * @param float $latitude
     * @param array|null $categoryIds
     * @param string|null $name
     * @param string|null $barcode
     *
     * @return Collection
     */
    public function findByConditions(
        int $offset,
        int $limit,
        int $customerId,
        int $distance,
        float $longitude,
        float $latitude,
        array $categoryIds = null,
        string $name = null,
        string $barcode = null
    ): Collection {
        $sql = PreparedStatementsHelper::getDistanceSql($latitude, $longitude);

        $query = Wish::active()
            ->where('customer_id', '<>', $customerId)
            ->withoutUnused()
            ->bidCount()
            ->with('lowestBid')
            ->selectRaw("{$sql} AS distance")
            ->whereRaw("{$sql} < ?", [$distance]);

        if (null !== $categoryIds) {
            $query->whereIn('category_id', $categoryIds);
        }
        if (null !== $name) {
            $query->where('name', 'like', "%{$name}%");
        }
        if (null !== $barcode) {
            $query->where('barcode', $barcode);
        }

        return $query->offset($offset)
            ->limit($limit)
            ->get();
    }

    // TODO MOVE TO DTO PARAMETERS !!!!

    /**
     * @param int $offset
     * @param int $limit
     * @param int $merchantId
     * @param int $distance
     * @param float $longitude
     * @param float $latitude
     * @param array|null $categoryIds
     * @param string|null $name
     * @param string|null $barcode
     *
     * @return Collection
     */
    public function findByConditionsForMerchant(
        int $offset,
        int $limit,
        int $merchantId,
        int $distance,
        float $longitude,
        float $latitude,
        array $categoryIds = null,
        string $name = null,
        string $barcode = null
    ): Collection {
        $sql = PreparedStatementsHelper::getDistanceSql($latitude, $longitude);

        $query = Wish::active()
            ->withoutUnused()
            ->doesntHave('declinedWishes')
            ->isBidByMe($merchantId)
            ->bidCount()
            ->with('lowestBid')
            ->selectRaw("{$sql} AS distance")
            ->whereRaw("{$sql} < ?", [$distance]);

        if (null !== $categoryIds) {
            $query->whereIn('category_id', $categoryIds);
        }
        if (null !== $name) {
            $query->where('name', 'like', "%{$name}%");
        }
        if (null !== $barcode) {
            $query->where('barcode', $barcode);
        }

        return $query->offset($offset)
            ->limit($limit)
            ->get();
    }

    /**
     * @param int $customerId
     * @param int $offset
     * @param int $limit
     * @param Carbon $dateStart
     * @param Carbon $dateEnd
     *
     * @return mixed
     */
    public function findBidResults(
        int $customerId,
        int $offset,
        int $limit,
        Carbon $dateStart,
        Carbon $dateEnd
    ) {
        return Wish::withoutUnused()
            ->with('lowestBid')
            ->with('bids.merchant.rating')
            ->bidCount()
            ->where('is_added_to_cart', false)
            ->where('customer_id', $customerId)
            ->whereDate('end_date', '>', $dateStart)
            ->whereDate('end_date', '<', $dateEnd)
            ->offset($offset)
            ->limit($limit)
            ->get();
    }
}
