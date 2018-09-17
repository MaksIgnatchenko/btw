<?php

namespace App\Modules\Orders\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Orders\DataTables\IncomeDataTable;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Orders\Requests\UpdateOrderRequest;
use App\Modules\Products\Helpers\CalculatorHelper;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Models\Transaction;
use App\Modules\Products\Repositories\TransactionRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class IncomeController extends Controller
{
    /**
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('web');
    }

    /** @var  OrderRepository */
    protected $orderRepository;
    /** @var  TransactionRepository */
    protected $transactionRepository;

    /**
     * IncomeController constructor.
     *
     * @param OrderRepository $orderRepository
     * @param TransactionRepository $transactionRepository
     */
    public function __construct(OrderRepository $orderRepository, TransactionRepository $transactionRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * @param IncomeDataTable $incomeDataTable
     *
     * @return mixed
     */
    public function index(IncomeDataTable $incomeDataTable)
    {
        /** @var Transaction $transaction */
        $transaction = app(Transaction::class);
        $statistic = $transaction->getIncomePaymentStatistic();

        return $incomeDataTable->render('income.index', ['statistic' => $statistic]);
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
        /** @var OrderRepository $orderRepository */
        $orderRepository = app(OrderRepository::class);
        $order = $orderRepository->findWithoutFail($id);

        if (null === $order) {
            Flash::error('Order not found');

            return redirect(route('payments.income.index'));
        }

        $product = app(Product::class);
        $product->forceFill((array)$order->product);
        $product->amount = CalculatorHelper::orderAmount($order);

        return view('income.show')->with(['order' => $order, 'product' => $product]);
    }

    /**
     * Update the specified MerchantReview in storage.
     *
     * @param int $id
     * @param UpdateOrderRequest $request
     *
     * @return RedirectResponse
     */
    public function update(int $id, UpdateOrderRequest $request): RedirectResponse
    {
        $merchantReview = $this->orderRepository->findWithoutFail($id);

        if (null === $merchantReview) {
            Flash::error('Order not found');

            return redirect(route('payments.income.index'));
        }

        $this->orderRepository->update(['status' => $request->get('status')], $id);

        Flash::success('Order updated successfully.');

        return redirect(route('payments.income.index'));
    }
}
