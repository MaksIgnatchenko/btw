<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.01.2018
 */

namespace App\Modules\Products\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Products\Events\TransactionCompletedEvent;
use App\Modules\Products\Models\Transaction;
use App\Modules\Products\Requests\Api\TransactionRequest;
use Braintree\Configuration;
use Braintree_Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * @param TransactionRequest $request
     *
     * @return JsonResponse
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function create(TransactionRequest $request): JsonResponse
    {
        // TODO how to move it from here??
        Configuration::environment(env('BT_ENVIRONMENT'));
        Configuration::merchantId(env('BT_MERCHANT_ID'));
        Configuration::publicKey(env('BT_PUBLIC_KEY'));
        Configuration::privateKey(env('BT_PRIVATE_KEY'));

        /** @var Transaction $transactionModel */
        $transactionModel = app(Transaction::class);

        $customerId = Auth::id();
        $amount = $request->get('amount');
        $noncence = $request->get('noncence');

        $transaction = $transactionModel->createTransaction($customerId, $amount);

        $result = Braintree_Transaction::sale([
            'amount' => $amount,
            'paymentMethodNonce' => $noncence,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

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
}
