<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 11.10.2018
 */

namespace App\Modules\Users\Customer\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class WishListRequest extends FormRequest
{
    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'offset' => 'sometimes|integer',
            'kyeword' => 'sometimes|string|max:100'
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
