<?php

namespace App\Modules\Users\Repositories;

use App\Helpers\PreparedStatementsHelper;
use App\Modules\Csv\Generator\DateDto;
use App\Modules\Csv\Generator\GetInRangeInterface;
use App\Modules\Users\Models\Merchant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class MerchantRepository extends UserTypeRepositoryAbstract implements GetInRangeInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'business_name',
        'user.email',
        'check',
        'user.username',
        'created_at',
    ];

    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return Merchant::class;
    }

    /**
     * @param float $longitude
     * @param float $latitude
     * @param int $radius
     *
     * @return Collection
     */
    public function getInRadius(float $longitude, float $latitude, int $radius): Collection
    {
        $sql = PreparedStatementsHelper::getDistanceSql($latitude, $longitude);

        return Merchant::query()
            ->select('id', 'user_id', 'latitude', 'longitude')
            ->selectRaw("{$sql} AS distance")
            ->whereRaw("{$sql} < ?", [$radius])
            ->get();
    }

    /**
     * @param int $merchantId
     *
     * @return Collection
     */
    public function getCategories(int $merchantId): Collection
    {
        return Merchant::query()->with('categories')->find($merchantId)->categories;
    }

    /**
     * @param int $merchantId
     * @param array $categoryIds
     */
    public function setCategories(int $merchantId, array $categoryIds): void
    {
        /** @var Merchant $merchant */
        $merchant = Merchant::find($merchantId);
        $merchant->categories()->sync($categoryIds);
    }

    /**
     * @param int $merchantId
     *
     * @return Merchant|null
     */
    public function findById(int $merchantId): ?Merchant
    {
        return Merchant::where('id', $merchantId)
            ->with([
                'merchantsReviews' => function ($query) {
                    return $query->select(['review', 'rate', 'merchant_id', 'customer_id']);
                }
            ])->first([
                'id',
                'business_name',
                'longitude',
                'latitude',
                'created_at',
                'address',
            ]);
    }

    /**
     * @param DateDto $dateDto
     *
     * @return Collection
     */
    public function getInRange(DateDto $dateDto): Collection
    {
        return Merchant::query()
            ->select([
                DB::raw('DATE_FORMAT(merchants.created_at, "%e %b %Y")  as Registered'),
                'merchants.business_name as Business name',
                'users.email as Email',
                DB::raw('case when merchants.check then \'Yes\' else \'No\' end as Verified'),
                'merchants.status as Status',
                'users.username as Username',
            ])
            ->whereBetween('merchants.created_at', [
                $dateDto->getDateFrom(),
                (new Carbon($dateDto->getDateTo()))->addDays(1)
            ])
            ->leftJoin('users', 'users.id', '=', 'merchants.user_id')
            ->get();
    }
}
