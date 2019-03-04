<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 04.03.2019
 */

namespace App\Modules\Reviews\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Reviews\Enums\ReviewTypesEnum;
use App\Modules\Reviews\Factories\ReviewRepositoryFactoryInterface;
use App\Modules\Reviews\Repositories\MerchantReviewRepository;
use App\Modules\Reviews\Repositories\ProductReviewRepository;
use App\Modules\Reviews\Repositories\ReviewRepositoryInterface;
use App\Modules\Reviews\Requests\CreateReviewRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class ReviewController
 * @package App\Modules\Reviews\Http\Controllers\Api
 */
class ReviewController extends Controller
{
    /**
     * @var ReviewRepositoryFactoryInterface
     */
    private $reviewRepositoryFactory;


    /**
     * ReviewController constructor.
     * @param ReviewRepositoryFactoryInterface $reviewRepositoryFactory
     */
    public function __construct(ReviewRepositoryFactoryInterface $reviewRepositoryFactory)
    {
        $this->reviewRepositoryFactory = $reviewRepositoryFactory;
    }

    /**
     * @param string $type
     * @param int $id
     * @return View
     */
    public function showReviews(string $type, int $id) : View
    {
        $reviews = $this->reviewRepositoryFactory
            ->getRepository($type)
            ->getActiveReviewsByOwnerIdPaginated(
                $id
            );

        if (null === $reviews) {
            return abort(404);
        }

        return view('reviews.web.list', [
            'reviews' => $reviews,
            'type' => $type,
        ]);
    }
}
