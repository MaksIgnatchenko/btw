<?php
/**
 * Created by Maksym Ignatchenko, Appus Studio LP on 14.06.19
 *
 */

namespace App\Modules\Orders\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Users\Admin\Services\SalesAnalyticsService\Interfaces\SalesAnalyticsInterface;

class SalesAnalyticsController extends Controller
{
    public function __invoke(SalesAnalyticsInterface $salesAnalyticsService)
    {
        $data = $salesAnalyticsService->getMonthlySalesAnalytics();
        return json_encode($data);
    }
}