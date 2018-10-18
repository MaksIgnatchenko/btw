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
            'password' => 'required|min:6|max:50',
            'company' => 'required|min:3|max:50',
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
