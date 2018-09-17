<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.11.2017
 */

namespace App\Modules\Users\Events;

use App\Modules\Users\Models\Merchant;
use App\Modules\Users\Requests\ModifyPaymentOptionsRequestInterface;

interface AddPaymentOptionEventInterface
{
    /**
     * @return Merchant
     */
    public function getMerchant(): Merchant;

    /**
     * @return ModifyPaymentOptionsRequestInterface
     */
    public function getRequest(): ModifyPaymentOptionsRequestInterface;

    /**
     * @return string
     */
    public function getPaymentOption(): string;
}
