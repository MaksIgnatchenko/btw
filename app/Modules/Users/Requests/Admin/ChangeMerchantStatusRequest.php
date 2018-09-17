<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.11.2017
 */

namespace App\Modules\Users\Http\Requests\Admin;

use App\Modules\Users\Enums\MerchantStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class ChangeMerchantStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => 'required|in:' . MerchantStatusEnum::ACTIVE . ',' . MerchantStatusEnum::NOT_ACTIVE,
        ];
    }
}
