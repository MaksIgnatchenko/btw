<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 18.02.2019
 */

namespace App\Modules\Reviews\Factories;

use App\Modules\Reviews\Enums\ReviewTypesEnum;
use App\Modules\Reviews\Exceptions\WrongReviewTypeException;
use App\Modules\Reviews\Repositories\MerchantReviewRepository;
use App\Modules\Reviews\Repositories\ProductReviewRepository;
use App\Modules\Reviews\Repositories\ReviewRepositoryInterface;

/**
 * Class ReviewRepositoryFactory
 * @package App\Modules\Reviews\Factories
 */
class ReviewRepositoryFactory implements ReviewRepositoryFactoryInterface
{

    /**
     * @param string $type
     * @return ReviewRepositoryInterface
     * @throws WrongReviewTypeException
     */
    public function getRepository(string $type) : ReviewRepositoryInterface
    {
        switch ($type) {
            case ReviewTypesEnum::MERCHANT:
                return app(MerchantReviewRepository::class);
            case ReviewTypesEnum::PRODUCT:
                return app(ProductReviewRepository::class);
            default:
                throw new WrongReviewTypeException("No such review type - $type");
                break;
        }
    }
}
