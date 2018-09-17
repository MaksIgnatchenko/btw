<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 07.11.2017
 */

namespace App\Modules\Payments\Models;

class WireTransferOption extends AbstractPaymentOptions
{
    /** @var array */
    protected $table = 'wire';

    /** @var array */
    protected $fillable = [
        'merchant_id',
        'bank_name',
        'aba_number',
        'account_name',
        'account_number',
    ];

    /**
     * @param array $data
     */
    public function fillModel(array $data): void
    {
        $this->merchant_id = $data['merchant_id'];
        $this->bank_name = $data['wire_bank_name'];
        $this->aba_number = $data['wire_aba_number'];
        $this->account_name = $data['wire_account_name'];
        $this->account_number = $data['wire_account_number'];
    }
}
