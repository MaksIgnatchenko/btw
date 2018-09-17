<?php

namespace App\Modules\Review\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Review\DataTables\ProductReviewDataTable;
use App\Modules\Review\Events\ProductReviewUpdatedEvent;
use App\Modules\Review\Repositories\ProductReviewRepository;
use App\Modules\Review\Requests\Admin\UpdateProductReviewRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProductReviewController extends Controller
{
    /**
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('web');
    }

    /** @var  ProductReviewRepository */
    protected $productReviewRepository;

    public function __construct(ProductReviewRepository $productReviewRepo)
    {
        $this->productReviewRepository = $productReviewRepo;
    }

    /**
     * @param ProductReviewDataTable $productReviewDataTable
     *
     * @return mixed
     */
    public function index(ProductReviewDataTable $productReviewDataTable)
    {
        return $productReviewDataTable->render('product_reviews.index');
    }

    /**
     * Show the form for creating a new ProductReview.
     *
     * @return Response
     */
    public function create(): Response
    {
        return view('product_reviews.create');
    }

    /**
     * Display the specified ProductReview.
     *
     * @param  int $id
     *
     * @return Response|RedirectResponse
     */
    public function view(int $id)
    {
        $productReview = $this->productReviewRepository->findWithoutFail($id);

        if (empty($productReview)) {
            Flash::error('Product Review not found');

            return redirect(route('review.products.index'));
        }

        return view('product_reviews.show')->with('productReview', $productReview);
    }

    /**
     * Update the specified ProductReview in storage.
     *
     * @param  int $id
     * @param UpdateProductReviewRequest $request
     *
     * @return RedirectResponse
     */
    public function update(int $id, UpdateProductReviewRequest $request): RedirectResponse
    {
        $productReview = $this->productReviewRepository->findWithoutFail($id);

        if (empty($productReview)) {
            Flash::error('Product Review not found');

            return redirect(route('review.products.index'));
        }

        $productReview = $this->productReviewRepository->update($request->all(), $id);

        $productReviewUpdatedEvent = app(ProductReviewUpdatedEvent::class, ['productReview' => $productReview]);
        event($productReviewUpdatedEvent);

        Flash::success('Product Review updated successfully.');

        return redirect(route('review.products.index'));
    }

    /**
     * Remove the specified ProductReview from storage.
     *
     * @param  int $id
     *
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $productReview = $this->productReviewRepository->findWithoutFail($id);

        if (empty($productReview)) {
            Flash::error('Product Review not found');

            return redirect(route('review.products.index'));
        }

        $this->productReviewRepository->delete($id);

        Flash::success('Product Review deleted successfully.');

        return redirect(route('review.products.index'));
    }
}
