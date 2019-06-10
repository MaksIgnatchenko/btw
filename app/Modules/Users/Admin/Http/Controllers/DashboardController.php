<?php

namespace App\Modules\Users\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Users\Admin\Dto\ImprovedHomeStatisticDto;
use App\Modules\Users\Merchant\Repositories\MerchantRepository;

class DashboardController extends Controller
{
    /**
     * @var \Illuminate\Foundation\Application|mixed
     */
    public $orderRepository;

    public $merchantsRepository;

    public function __construct()
    {
        parent::__construct();
        $this->orderRepository = app(OrderRepository::class);
        $this->merchantsRepository = app(MerchantRepository::class);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $statistic = new ImprovedHomeStatisticDto();

        $statistic->setOrdersCount($this->orderRepository->getAllCount())
            ->setMerchantsCount($this->merchantsRepository->getAllCount())
            ->setOverallIncome($this->orderRepository->getTotalIncome());


//        $reviewCount = $this->merchantReview->getPendingReviewCount() + $this->productReview->getPendingReviewCount();
//        $transactions = $this->transactionRepository->findActive();


//        $statistic->setMerchantMarkers($this->merchant->getMarkers())
//            ->setMerchantsCount($this->merchant->getCount())
//            ->setPendingMerchantsCount($this->merchant->getPendingCount())
//            ->setProductsStatistic($this->category->getProductsStatistic())
//            ->setProductsCount($this->product->getCount())
//            ->setReviewsToApproveCount($reviewCount)
//            ->setOverallIncome($transactions->sum('amount'));

        return view('home', ['statistic' => $statistic]);
    }
}
