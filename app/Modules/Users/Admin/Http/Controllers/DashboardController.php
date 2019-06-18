<?php

namespace App\Modules\Users\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Users\Admin\Dto\ImprovedHomeStatisticDto;
use App\Modules\Users\Admin\Services\SalesAnalyticsService\Interfaces\SalesAnalyticsInterface;
use App\Modules\Users\Merchant\Repositories\MerchantRepository;

class DashboardController extends Controller
{

    /**
     * @var \Illuminate\Foundation\Application|mixed
     */
    public $salesAnalyticsService;

    /**
     * @var \Illuminate\Foundation\Application|mixed
     */
    public $merchantsRepository;

    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->salesAnalyticsService = app(SalesAnalyticsInterface::class);
        $this->merchantsRepository = app(MerchantRepository::class);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $statistic = new ImprovedHomeStatisticDto();

        $statistic->setOrdersCount($this->salesAnalyticsService->getAllOrdersCount())
            ->setOrdersCountByRegions($this->salesAnalyticsService->getStatesStatistic())
            ->setMerchantsCount($this->merchantsRepository->getAllCount())
            ->setOverallIncome($this->salesAnalyticsService->getTotalIncome());

        return view('home', ['statistic' => $statistic]);
    }
}
