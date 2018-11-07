<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 1.11.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Users\Merchant\Models\Merchant;

class MerchantController extends Controller
{
    /**
     * @param Merchant $merchant
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Merchant $merchant)
    {
        $merchant = $merchant->load('store');

        return response()->json([
            'merchant' => $merchant,
        ]);
    }
}
