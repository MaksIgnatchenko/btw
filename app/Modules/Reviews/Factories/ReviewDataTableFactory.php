<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 18.02.2019
 */

namespace App\Modules\Reviews\Factories;

use App\Modules\Reviews\DataTables\MerchantReviewDataTable;
use App\Modules\Reviews\DataTables\ProductReviewDataTable;
use App\Modules\Reviews\Enums\ReviewTypesEnum;
use App\Modules\Reviews\Exceptions\WrongReviewTypeException;
use App\Modules\Users\Merchant\DataTables\MerchantDataTable;
use Yajra\DataTables\Services\DataTable;

/**
 * Class ReviewDataTableFactory
 * @package App\Modules\Reviews\Factories
 */
class ReviewDataTableFactory implements ReviewDataTableFactoryInterface
{
    /**
     * @param string $type
     * @return DataTable
     * @throws WrongReviewTypeException
     */
    public function getDataTableByType(string $type): DataTable
    {
        switch ($type) {
            case ReviewTypesEnum::PRODUCT:
                return app(ProductReviewDataTable::class);
            case ReviewTypesEnum::MERCHANT:
                return app(MerchantReviewDataTable::class);
            default:
                throw new WrongReviewTypeException("No such review type - $type");
        }
    }
}
