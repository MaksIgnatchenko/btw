<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 15.02.2019
 */

namespace App\Modules\Reviews\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Reviews\Enums\ReviewTypesEnum;
use App\Modules\Reviews\Factories\ReviewDataTableFactoryInterface;
use App\Modules\Reviews\Factories\ReviewRepositoryFactoryInterface;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

/**
 * Class ReviewController
 * @package App\Modules\Reviews\Http\Controllers\Admin
 */
class ReviewController extends Controller
{
    /**
     * @var ReviewRepositoryFactoryInterface
     */
    private $reviewRepositoryFactory;
    /**
     * @var ReviewDataTableFactoryInterface
     */
    private $reviewDataTableFactory;

    /**
     * ReviewController constructor.
     * @param ReviewRepositoryFactoryInterface $reviewRepositoryFactory
     * @param ReviewDataTableFactoryInterface $reviewDataTableFactory
     */
    public function __construct(
        ReviewRepositoryFactoryInterface $reviewRepositoryFactory,
        ReviewDataTableFactoryInterface $reviewDataTableFactory
    ) {
        $this->reviewRepositoryFactory = $reviewRepositoryFactory;
        $this->reviewDataTableFactory = $reviewDataTableFactory;
    }

    /**
     * @param Request $request
     * @param string $type
     * @return mixed
     */
    public function index(Request $request, string $type)
    {
        $dataTable = $this->reviewDataTableFactory->getDataTableByType($type);

        return $dataTable->render('reviews.index', ['type' => $type,]);
    }

    /**
     * @param Request $request
     * @param string $type
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, string $type, int $id)
    {
        $review = $this->reviewRepositoryFactory
           ->getRepository($type)
           ->getReview($id);

        return view('reviews.show', compact('type', 'review'));
    }

    /**
     * @param Request $request
     * @param string $type
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, string $type, int $id)
    {
        $review = $this->reviewRepositoryFactory->getRepository($type)->find($id);
        $review->rating = $request->get('rating');
        $review->comment = $request->get('comment');
        $review->status = $request->get('status');
        $review->save(); //TODO clarify BaseRepository update wont save status value

        Flash::success('Review updated successfully');

        return redirect(route('reviews.index', ['reviewType' => $type,]));
    }
}
