<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.01.2018
 */

namespace App\Modules\Products\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Products\Events\TransactionCompletedEvent;
use App\Modules\Products\Models\Transaction;
use App\Modules\Products\Requests\Api\TransactionRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /** @var \Braintree_Gateway */
    protected $gateway;

    /**
     * TransactionController constructor.
     */
    public function __construct()
    {
        //todo to clarify why it`s not working as constructor parameter
        $this->gateway = resolve(\Braintree_Gateway::class);
    }

    /**
     * @param TransactionRequest $request
     *
     * @return JsonResponse
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function create(TransactionRequest $request): JsonResponse
    {
        /** @var Transaction $transactionModel */
        $transactionModel = app(Transaction::class);

        $customerId = Auth::id();
        $amount = $request->get('amount');
        $noncence = $request->get('noncence');

        $transaction = $transactionModel->createTransaction($customerId, $amount);

        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $noncence,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        if (!$result->success) {
            $transaction->message = $result->message;
            $transaction->save();
        }

        /** @var TransactionCompletedEvent $transactionCompletedEvent */
        $transactionCompletedEvent = app(TransactionCompletedEvent::class);
        $transactionCompletedEvent->setTransaction($transaction)->setResult($result);
        event($transactionCompletedEvent);

        if ($result->success) {
            return response()->json([
                'success' => true,
                'message' => "Success ID: {$result->transaction->id}",
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result->message,
        ], 400);
    }

    /**
     * @return JsonResponse
     */
    public function generateToken(): JsonResponse
    {
        $token = $this->gateway->clientToken()->generate();

        return response()->json([
            'token' => $token,
        ]);
    }
}
