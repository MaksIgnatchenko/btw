<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 12.10.2018
 */

namespace App\Modules\Users\Merchant\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterMerchantCompanyRequest extends FormRequest
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
            'store_name' => 'required|string|min:3|max:100',
            'email' => 'required|email',
            'password' => 'required|min:8|max:100|confirmed',
        ];
    }
}