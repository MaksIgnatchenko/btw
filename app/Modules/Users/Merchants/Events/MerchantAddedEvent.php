<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 12.10.2018
 */

/**
 * Created by Artem Petrov, Appus Studio LP on 13.11.2017
 */

namespace App\Modules\Users\Events;

use App\Modules\Users\Models\Merchant;
use App\Modules\Users\Models\User;
use App\Modules\Users\Requests\ModifyPaymentOptionsRequestInterface;
use Illuminate\Queue\SerializesModels;

class MerchantAddedEvent implements AddRoleEventInterface, AddPaymentOptionEventInterface
{
    use SerializesModels;

    /** User $request */
    protected $user;
    /** Merchant $request */
    protected $merchant;
    /** RegisterMerchantRequest $request */
    protected $request;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Merchant $merchant
     * @param ModifyPaymentOptionsRequestInterface $request
     */
    public function __construct(User $user, Merchant $merchant, ModifyPaymentOptionsRequestInterface $request)
    {
        $this->user = $user;
        $this->merchant = $merchant;
        $this->request = $request;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
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
