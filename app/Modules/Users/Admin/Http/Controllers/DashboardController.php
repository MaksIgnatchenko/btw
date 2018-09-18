<?php

namespace App\Modules\Users\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Users\Admin\Dto\HomeStatisticDto;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $statistic = new HomeStatisticDto();

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
