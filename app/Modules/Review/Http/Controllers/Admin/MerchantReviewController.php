<?php

namespace App\Modules\Review\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Review\DataTables\MerchantReviewDataTable;
use App\Modules\Review\Events\MerchantReviewUpdatedEvent;
use App\Modules\Review\Repositories\MerchantReviewRepository;
use App\Modules\Review\Requests\Admin\UpdateMerchantReviewRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class MerchantReviewController extends Controller
{
    /**
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('web');
    }

    /** @var  MerchantReviewRepository */
    protected $merchantReviewRepository;

    public function __construct(MerchantReviewRepository $merchantReviewRepository)
    {
        $this->merchantReviewRepository = $merchantReviewRepository;
    }

    /**
     * @param MerchantReviewDataTable $merchantReviewDataTable
     *
     * @return mixed
     */
    public function index(MerchantReviewDataTable $merchantReviewDataTable)
    {
        return $merchantReviewDataTable->render('merchant_reviews.index');
    }

    /**
     * Show the form for creating a new MerchantReview.
     *
     * @return Response
     */
    public function create(): Response
    {
        return view('merchant_reviews.create');
    }

    /**
     * Display the specified MerchantReview.
     *
     * @param  int $id
     *
     * @return Response|RedirectResponse
     */
    public function view(int $id)
    {
        $merchantReview = $this->merchantReviewRepository->findWithoutFail($id);

        if (null === $merchantReview) {
            Flash::error('Merchant Review not found');

            return redirect(route('review.merchants.index'));
        }

        return view('merchant_reviews.show')->with('merchantReview', $merchantReview);
    }

    /**
     * Update the specified MerchantReview in storage.
     *
     * @param int $id
     * @param UpdateMerchantReviewRequest $request
     *
     * @return RedirectResponse
     */
    public function update(int $id, UpdateMerchantReviewRequest $request): RedirectResponse
    {
        $merchantReview = $this->merchantReviewRepository->findWithoutFail($id);

        if (null === $merchantReview) {
            Flash::error('Merchant Review not found');

            return redirect(route('review.merchants.index'));
        }

        $merchantReview = $this->merchantReviewRepository->update($request->all(), $id);

        $merchantReviewUpdatedEvent = app(MerchantReviewUpdatedEvent::class, [
            'merchantReview' => $merchantReview,
        ]);
        event($merchantReviewUpdatedEvent);

        Flash::success('Merchant Review updated successfully.');

        return redirect(route('review.merchants.index'));
    }

    /**
     * Remove the specified MerchantReview from storage.
     *
     * @param  int $id
     *
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $merchantReview = $this->merchantReviewRepository->findWithoutFail($id);

        if (null === $merchantReview) {
            Flash::error('Merchant Review not found');

            return redirect(route('review.merchants.index'));
        }

        $this->merchantReviewRepository->delete($id);

        Flash::success('Merchant Review deleted successfully.');

        return redirect(route('review.merchants.index'));
    }
}
