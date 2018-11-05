<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 5.11.2018
 */

namespace App\Modules\Users\Merchant\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetMerchantProductsRequest extends FormRequest
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
            'offset' => 'nullable|integer',
        ];
    }
}
