<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 07.11.2017
 */

namespace App\Modules\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterMerchantRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|min:1|max:100',
            'password' => 'required|digits:10',
            'ein' => 'required|regex:/\b\d{9}\b/',
        ];
    }


    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
