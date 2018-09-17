<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.11.2017
 */

namespace App\Modules\Payments\Listeners;

use App\Modules\Payments\Factories\PaymentOptionModelFactory;
use App\Modules\Users\Enums\PaymentOptionsEnum;
use App\Modules\Users\Events\AddPaymentOptionEventInterface;
use App\Modules\Users\Events\ChangePaymentOptionEvent;
use App\Modules\Users\Events\MerchantAddedEvent;

class AddPaymentOptionSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param $events
     */
    public function subscribe($events): void
    {
        $events->listen(
            MerchantAddedEvent::class,
            self::class . '@addPaymentInfo'
        );

        $events->listen(
            ChangePaymentOptionEvent::class,
            self::class . '@changePaymentInfo'
        );
    }

    /**
     * Handle user login events.
     *
     * @param AddPaymentOptionEventInterface $event
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     * @throws \App\Modules\Payments\Exceptions\WrongPaymentTypeException
     */
    public function changePaymentInfo(AddPaymentOptionEventInterface $event): void
    {
        $newPaymentOption = $event->getRequest()->get('payment_option');
        $oldPaymentOption = $event->getMerchant()->payment_option;

        $merchantId = $event->getMerchant()->id;

        if ($oldPaymentOption !== PaymentOptionsEnum::CHEQUE) {
            $paymentRepository = PaymentOptionModelFactory::getRepository($oldPaymentOption);
            $paymentRepository->deleteWhere(['merchant_id' => $merchantId]);
        }

        if ($newPaymentOption !== PaymentOptionsEnum::CHEQUE) {
            $this->addPaymentRecord($event);
        }
    }

    /**
     * Handle user login events.
     *
     * @param AddPaymentOptionEventInterface $event
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     * @throws \App\Modules\Payments\Exceptions\WrongPaymentTypeException
     */
    public function addPaymentInfo(AddPaymentOptionEventInterface $event): void
    {
        $this->addPaymentRecord($event);
    }

    protected function addPaymentRecord(AddPaymentOptionEventInterface $event): void
    {
        $paymentOption = $event->getPaymentOption();

        // we don't need any action if cheque
        if (PaymentOptionsEnum::CHEQUE === $paymentOption) {
            return;
        }

        $merchant = $event->getMerchant();

        $paymentOptionModel = PaymentOptionModelFactory::getModel($paymentOption);

        $paymentOptionData = ['merchant_id' => $merchant->id] + $event->getRequest()->all();
        $paymentOptionModel->fillModel($paymentOptionData);
        $paymentOptionModel->save();
    }
}
