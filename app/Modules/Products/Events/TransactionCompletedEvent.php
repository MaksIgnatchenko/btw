<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.01.2018
 */

namespace App\Modules\Products\Events;

use App\Modules\Products\Models\Transaction;
use Braintree\Base;
use Braintree\Result\Error;
use Braintree\Result\Successful;
use Illuminate\Queue\SerializesModels;

class TransactionCompletedEvent
{
    use SerializesModels;

    /** @var Transaction */
    protected $transaction;
    /** @var Base */
    protected $result;

    /**
     * @return Transaction
     */
    public function getTransaction(): Transaction
    {
        return $this->transaction;
    }

    /**
     * @param Transaction $transaction
     *
     * @return TransactionCompletedEvent
     */
    public function setTransaction(Transaction $transaction): TransactionCompletedEvent
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * @return Successful|Error
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param Successful|Error $result
     *
     * @return TransactionCompletedEvent
     */
    public function setResult($result): TransactionCompletedEvent
    {
        $this->result = $result;

        return $this;
    }
}
