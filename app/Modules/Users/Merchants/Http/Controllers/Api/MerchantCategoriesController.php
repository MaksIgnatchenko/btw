<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 26.12.2017
 */

namespace App\Modules\Users\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Users\Models\User;
use App\Modules\Users\Repositories\MerchantRepository;
use App\Modules\Users\Requests\Api\SetMerchantsCategoriesRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MerchantCategoriesController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        /** @var MerchantRepository $merchantRepository */
        $merchantRepository = app()[MerchantRepository::class];
        /** @var User $user */
        $user = Auth::user();
        /** @var int $merchantId */
        $merchantId = $user->merchant->id;

        $categories = $merchantRepository->getCategories($merchantId);

        return response()->json(['categories' => $categories->pluck('id')]);
    }

    /**
     * @param SetMerchantsCategoriesRequest $request
     *
     * @return JsonResponse
     */
    public function set(SetMerchantsCategoriesRequest $request): JsonResponse
    {
        $categoryIds = $request->get('categories');
        /** @var MerchantRepository $merchantRepository */
        $merchantRepository = app()[MerchantRepository::class];
        /** @var User $user */
        $user = Auth::user();
        /** @var int $merchantId */
        $merchantId = $user->merchant->id;

        $merchantRepository->setCategories($merchantId, $categoryIds);

        return response()->json(['success' => true]);
    }
}
