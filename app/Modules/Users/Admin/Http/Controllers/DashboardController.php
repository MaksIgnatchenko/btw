<?php

namespace App\Modules\Users\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Users\Admin\Dto\ImprovedHomeStatisticDto;
use App\Modules\Users\Admin\Services\GeographicalAnalyzerOfOrdersService\Implementations\UsaGeographicalAnalyzerOfOrdersService;
use App\Modules\Users\Admin\Services\GeographicalAnalyzerOfOrdersService\Interfaces\GeographicalAnalyzerOfOrdersServiceInterface;
use App\Modules\Users\Admin\Services\OrdersCountByRegionsService\Interfaces\OrdersCountByRegionsServiceInterface;
use App\Modules\Users\Merchant\Repositories\MerchantRepository;

class DashboardController extends Controller
{
    /**
     * @var \Illuminate\Foundation\Application|mixed
     */
    public $orderRepository;

    public $merchantsRepository;

    public $ordersCountByRegionsService;

    public function __construct()
    {
        parent::__construct();
        $this->orderRepository = app(OrderRepository::class);
        $this->merchantsRepository = app(MerchantRepository::class);
        $this->ordersCountByRegionsService = app(OrdersCountByRegionsServiceInterface::class);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $statistic = new ImprovedHomeStatisticDto();

        $statistic->setOrdersCount($this->orderRepository->getAllCount())
            ->setOrdersCountByRegions($this->ordersCountByRegionsService->getStatesStatistic())
            ->setMerchantsCount($this->merchantsRepository->getAllCount())
            ->setOverallIncome($this->orderRepository->getTotalIncome());

        return view('home', ['statistic' => $statistic]);
    }
}
