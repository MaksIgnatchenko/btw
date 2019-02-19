<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 15.02.2019
 */

namespace App\Modules\Reviews\Providers;

use App\Modules\Reviews\Enums\ReviewTypesEnum;
use App\Modules\Reviews\Factories\ReviewDataTableFactory;
use App\Modules\Reviews\Factories\ReviewDataTableFactoryInterface;
use App\Modules\Reviews\Factories\ReviewRepositoryFactory;
use App\Modules\Reviews\Factories\ReviewRepositoryFactoryInterface;
use App\Modules\Reviews\Repositories\MerchantReviewRepository;
use App\Modules\Reviews\Repositories\ProductReviewRepository;
use App\Modules\Reviews\Repositories\ReviewRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

/**
 * Class ReviewServiceProvider
 * @package App\Modules\Reviews\Providers
 */
class ReviewServiceProvider extends ServiceProvider
{
    /**
     *
     */
    public function register() : void
    {
        $this->app->singleton(ReviewRepositoryFactoryInterface::class, function () {
            return new ReviewRepositoryFactory();
        });
        $this->app->singleton(ReviewDataTableFactoryInterface::class, function () {
            return new ReviewDataTableFactory();
        });
    }
}
