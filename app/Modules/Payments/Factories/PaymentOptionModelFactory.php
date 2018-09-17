<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.11.2017
 */

namespace App\Modules\Payments\Factories;

use App\Modules\Payments\Exceptions\WrongPaymentTypeException;
use App\Modules\Payments\Models\AbstractPaymentOptions;
use App\Modules\Payments\Models\PayPalOption;
use App\Modules\Payments\Models\WireTransferOption;
use App\Modules\Payments\Repositories\PayPalRepository;
use App\Modules\Payments\Repositories\WireRepository;
use App\Modules\Users\Enums\PaymentOptionsEnum;
use InfyOm\Generator\Common\BaseRepository;

class PaymentOptionModelFactory
{
    /**
     * @param string $option
     *
     * @return AbstractPaymentOptions
     * @throws WrongPaymentTypeException
     */
    public static function getModel(string $option): AbstractPaymentOptions
    {
        switch ($option) {
            case PaymentOptionsEnum::WIRE:
                return new WireTransferOption();
            case PaymentOptionsEnum::PAYPAL:
                return new PayPalOption();
            default:
                throw new WrongPaymentTypeException("No such payment option - {$option}");
        }
    }


    /**
     * @param string $option
     *
     * @return BaseRepository
     * @throws WrongPaymentTypeException
     */
    public static function getRepository(string $option): BaseRepository
    {
        switch ($option) {
            case PaymentOptionsEnum::WIRE:
                return app()[WireRepository::class];
            case PaymentOptionsEnum::PAYPAL:
                return app()[PayPalRepository::class];
            default:
                throw new WrongPaymentTypeException("No repository for payment option - {$option}");
        }
    }
}
