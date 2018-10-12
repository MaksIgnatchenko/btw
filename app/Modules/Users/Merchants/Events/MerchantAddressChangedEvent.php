<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 24.04.2018
 */

namespace App\Modules\Users\Events;

use App\Modules\Users\Models\Merchant;
use Illuminate\Queue\SerializesModels;

class MerchantAddressChangedEvent
{
    use SerializesModels;

    /** @var Merchant $merchant */
    protected $merchant;

    /**
     * @return Merchant
     */
    public function getMerchant(): Merchant
    {
        return $this->merchant;
    }

    /**
     * @param Merchant $merchant
     *
     * @return MerchantAddressChangedEvent
     */
    public function setMerchant(Merchant $merchant): MerchantAddressChangedEvent
    {
        $this->merchant = $merchant;

        return $this;
    }
}
