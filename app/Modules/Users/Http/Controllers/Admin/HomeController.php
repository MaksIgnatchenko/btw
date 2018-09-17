<?php

namespace App\Modules\Users\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Categories\Models\Category;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Repositories\TransactionRepository;
use App\Modules\Review\Models\MerchantReview;
use App\Modules\Review\Models\ProductReview;
use App\Modules\Users\Dto\HomeStatisticDto;
use App\Modules\Users\Http\Requests\Admin\ChangeAdminPasswordRequest;
use App\Modules\Users\Models\Admin;
use App\Modules\Users\Models\Merchant;
use App\Modules\Users\Repositories\AdminRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class HomeController extends Controller
{
    /** @var Merchant */
    protected $merchant;
    /** @var Category */
    protected $category;
    /** @var Product */
    protected $product;
    /** @var MerchantReview */
    protected $merchantReview;
    /** @var ProductReview */
    protected $productReview;
    /** @var TransactionRepository */
    protected $transactionRepository;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->merchant = app(Merchant::class);
        $this->category = app(Category::class);
        $this->product = app(Product::class);
        $this->merchantReview = app(MerchantReview::class);
        $this->productReview = app(ProductReview::class);
        $this->transactionRepository = app(TransactionRepository::class);
    }

    /**
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statistic = new HomeStatisticDto();

        $reviewCount = $this->merchantReview->getPendingReviewCount() + $this->productReview->getPendingReviewCount();
        $transactions = $this->transactionRepository->findActive();


        $statistic->setMerchantMarkers($this->merchant->getMarkers())
            ->setMerchantsCount($this->merchant->getCount())
            ->setPendingMerchantsCount($this->merchant->getPendingCount())
            ->setProductsStatistic($this->category->getProductsStatistic())
            ->setProductsCount($this->product->getCount())
            ->setReviewsToApproveCount($reviewCount)
            ->setOverallIncome($transactions->sum('amount'));

        return view('home', ['statistic' => $statistic]);
    }

    /**
     * Show the application dashboard.
     *
     * @param ChangeAdminPasswordRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(ChangeAdminPasswordRequest $request): RedirectResponse
    {
        /** @var Admin $admin */
        $admin = Auth::user();
        /** @var AdminRepository $adminRepository */
        $adminRepository = app()[AdminRepository::class];

        $admin->password = $request->get('password');
        $adminRepository->save($admin);

        Flash::success('Password changed successfully');

        return back();
    }
}
