<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 13.02.2019
 */

namespace App\Modules\Reviews\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Products\Models\Product;
use App\Modules\Reviews\Models\MerchantReview;
use App\Modules\Reviews\Repositories\MerchantReviewRepository;
use App\Modules\Reviews\Requests\CreateMerchantReviewRequest;
use Illuminate\Http\Request;

class MerchantReviewController extends Controller
{
    /**
     * @var MerchantReviewRepository
     */
    private $merchantReviewRepository;


    public function __construct(MerchantReviewRepository $merchantReviewRepository)
    {
        $this->merchantReviewRepository = $merchantReviewRepository;
    }



    public function show(MerchantReview $review)
    {
        return view('reviews.merchant.show', compact('review'));
    }

    public function index(Request $request)
    {
        $reviews = $this->merchantReviewRepository->getActiveReviews($request->get('offset', 0));

        return view('reviews.merchant.list', compact('reviews'));
    }
}
