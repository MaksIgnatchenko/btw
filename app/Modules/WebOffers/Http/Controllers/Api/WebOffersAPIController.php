<?php

namespace App\Modules\WebOffers\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Categories\Repositories\CategoryRepository;
use App\Modules\WebOffers\Models\WebOffer;
use App\Modules\WebOffers\Requests\Admin\GetWebOffersRequest;
use Illuminate\Http\JsonResponse;

class WebOffersAPIController extends Controller
{
    /** @var CategoryRepository */
    protected $categoryRepository;

    /**
     * WebOffersAPIController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->categoryRepository = app(CategoryRepository::class);
    }

    /**
     * @param GetWebOffersRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Modules\WebOffers\Exceptions\ParserException
     */
    public function index(GetWebOffersRequest $request): JsonResponse
    {
        /** @var WebOffer $webOffer */
        $webOffer = app(WebOffer::class);
        $name = $request->get('name', '');
        $upc = $request->get('upc', '');
        $categoryId = $request->get('category_id');
        $categoryName = null;
        if ($categoryId) {
            $categoryName = $this->categoryRepository->find($categoryId)->name;
        }

        $webOffers = $webOffer->search($name, $upc, $categoryName);

        return response()->json([
            'web_offers' => $webOffers,
        ]);
    }
}
