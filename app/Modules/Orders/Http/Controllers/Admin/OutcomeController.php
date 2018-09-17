<?php

namespace App\Modules\Orders\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Orders\DataTables\OutcomeDataTable;
use App\Modules\Orders\Models\Order;
use App\Modules\Orders\Models\Outcome;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Orders\Repositories\OutcomeRepository;
use App\Modules\Orders\Requests\CreateOutcomeRequest;
use App\Modules\Orders\Requests\GetMerchantOrdersRequest;
use App\Modules\Orders\Requests\UpdateOutcomeRequest;
use App\Modules\Users\Repositories\MerchantRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpFoundation\RedirectResponse;

class OutcomeController extends Controller
{
    /**
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('web');
    }

    /**
     * @param OutcomeDataTable $productReviewDataTable
     *
     * @return mixed
     */
    public function index(OutcomeDataTable $productReviewDataTable)
    {
        $outcome = app(Outcome::class);
        $statistic = $outcome->getStatistic();

        return $productReviewDataTable->render('outcome.index', ['statistic' => $statistic]);
    }

    /**
     * Show the form for creating a new ProductReview.
     *
     * @return Response
     */
    public function create()
    {
        // TODO MOVE TO MODEL AND DTO
        /** @var MerchantRepository $merchantRepository */
        $merchantRepository = app(MerchantRepository::class);
        $merchants = $merchantRepository->all();
        /** @var OrderRepository $orderRepository */
        $orderRepository = app(OrderRepository::class);

        $merchant = $merchants->first();
        $merchantId = $merchant->id;
        if (null !== old('merchant_id')) {
            $merchantId = old('merchant_id');
        }

        $merchantOrders = $orderRepository->findWhere(['merchant_id' => $merchantId]);

        // TODO move to model or helper formatting
        $merchantsFormatted = $merchants->keyBy('id')->transform(function ($item) {
            return "{$item->business_name} ({$item->user->email})";
        });

        if (!empty(old('order_id'))) {
            $ordersFromOutcome = $orderRepository->findWhereIn('id', old('order_id'));
        }

        return view('outcome.create')->with([
            'merchantsFormatted' => $merchantsFormatted,
            'ordersFromOutcome'  => $ordersFromOutcome ?? [],
            'merchantOrders'     => $merchantOrders,
            'editableMerchant'   => true,
        ]);
    }

    /**
     * Create the specified Outcome in storage.
     *
     * @param CreateOutcomeRequest $request
     *
     * @return RedirectResponse
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function store(CreateOutcomeRequest $request): RedirectResponse
    {
        /** @var OutcomeRepository $outcomeRepository */
        $outcomeRepository = app(OutcomeRepository::class);
        /** @var Outcome $outcome */
        $outcome = app(Outcome::class);
        $orderIds = $request->get('order_id', []);

        $outcome->fill($request->all());
        $outcomeRepository->updateWithOrders($outcome, $orderIds);

        Flash::success('Outcome updated successfully.');

        return redirect(route('outcome.index'));
    }

    /**
     * Display the specified ProductReview.
     *
     * @param  int $id
     *
     * @return Response|RedirectResponse
     */
    public function edit(int $id)
    {
        $outcomeRepository = app(OutcomeRepository::class);
        $outcome = $outcomeRepository->findWithoutFail($id);

        if (null === $outcome) {
            Flash::error('Outcome not found');

            return redirect(route('outcome.index'));
        }

        // TODO MOVE TO MODEL AND DTO
        /** @var MerchantRepository $merchantRepository */
        $merchantRepository = app(MerchantRepository::class);
        $merchants = $merchantRepository->all();
        /** @var OrderRepository $orderRepository */
        $orderRepository = app(OrderRepository::class);
        $ordersFromOutcome = $orderRepository->findWhere(['outcome_id' => $outcome->id]);
        $merchantOrders = $orderRepository->findWhere(['merchant_id' => $outcome->merchant->id]);

        // TODO move to model or helper formatting
        $merchantsFormatted = $merchants->keyBy('id')->transform(function ($item) {
            return "{$item->business_name} ({$item->user->email})";
        });

        return view('outcome.show')->with([
            'outcome'            => $outcome,
            'merchantsFormatted' => $merchantsFormatted,
            'ordersFromOutcome'  => $ordersFromOutcome,
            'merchantOrders'     => $merchantOrders,
            'editableMerchant'   => false,
        ]);
    }

    /**
     * Update the specified ProductReview in storage.
     *
     * @param int $id
     * @param UpdateOutcomeRequest $request
     *
     * @return RedirectResponse
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function update(int $id, UpdateOutcomeRequest $request): RedirectResponse
    {
        /** @var OutcomeRepository $outcomeRepository */
        $outcomeRepository = app(OutcomeRepository::class);
        /** @var Outcome $outcome */
        $outcome = $outcomeRepository->findWithoutFail($id);
        $orderIds = $request->get('order_id', []);

        if (null === $outcome) {
            Flash::error('Outcome not found');

            return redirect(route('outcome.index'));
        }
        $outcome->fillable(['amount', 'payment_type', 'payment_date', 'fee', 'net_amount']);
        $outcome->fill($request->all());
        $outcomeRepository->updateWithOrders($outcome, $orderIds);

        Flash::success('Outcome updated successfully.');

        return redirect(route('outcome.index'));
    }

    /**
     * Remove the specified ProductReview from storage.
     *
     * @param  int $id
     *
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $outcomeRepository = app(OutcomeRepository::class);
        /** @var Outcome $outcome */
        $outcome = $outcomeRepository->findWithoutFail($id);
        if (null === $outcome) {
            Flash::error('Outcome not found');

            return redirect(route('outcome.index'));
        }

        $outcome->drop();

        Flash::success('Outcome deleted successfully.');

        return redirect(route('outcome.index'));
    }

    /**
     * @param GetMerchantOrdersRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function merchantOrders(GetMerchantOrdersRequest $request): JsonResponse
    {
        $merchantId = $request->get('merchant_id');
        /** @var Order $orderModel */
        $orderModel = app(Order::class);
        $orders = $orderModel->getMerchantNotPaidOrders($merchantId);

        return response()->json(['orders' => $orders]);
    }
}
