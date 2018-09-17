<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 23.01.2018
 */


namespace App\Modules\Orders\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetMerchantOrdersRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'merchant_id' => 'required|exists:merchants,id',
        ];
    }
}
