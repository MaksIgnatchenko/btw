<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 07.11.2017
 */

namespace App\Modules\Payments\Models;

class PayPalOption extends AbstractPaymentOptions
{
    /** @var array */
    protected $table = 'paypal';

    /** @var array */
    protected $fillable = [
        'merchant_id',
        'email',
    ];

    /**
     * @param array $data
     */
    public function fillModel(array $data)
    {
        $this->merchant_id = $data['merchant_id'];
        $this->email = $data['paypal_email'];
    }
}
