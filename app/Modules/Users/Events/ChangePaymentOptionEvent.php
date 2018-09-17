<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.12.2017
 */

namespace App\Modules\Users\Events;

use App\Modules\Users\Models\Merchant;
use App\Modules\Users\Requests\ModifyPaymentOptionsRequestInterface;
use Illuminate\Queue\SerializesModels;

class ChangePaymentOptionEvent implements AddPaymentOptionEventInterface
{
    use SerializesModels;


    /** Merchant $request */
    protected $merchant;
    /** UpdatePayoutOptionsRequest $request */
    protected $request;

    /**
     * Create a new event instance.
     *
     * @param Merchant $merchant
     * @param ModifyPaymentOptionsRequestInterface $request
     */
    public function __construct(Merchant $merchant, ModifyPaymentOptionsRequestInterface $request)
    {
        $this->merchant = $merchant;
        $this->request = $request;
    }

    /**
     * @return Merchant
     */
    public function getMerchant(): Merchant
    {
        return $this->merchant;
    }

    /**
     * @return ModifyPaymentOptionsRequestInterface
     */
    public function getRequest(): ModifyPaymentOptionsRequestInterface
    {
        return $this->request;
    }

    /**
     * @return string
     */
    public function getPaymentOption(): string
    {
        return $this->request->get('payment_option');
    }
}
