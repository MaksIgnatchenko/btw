<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 30.01.2018
 */

namespace App\Modules\Bidding\Http\Requests\Api;

use App\Modules\Bidding\Enums\CustomerFilterEnum;
use App\Modules\Bidding\Enums\MerchantFilterEnum;
use App\Modules\Rbac\Enum\RolesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class GetWishesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $user = Auth::user();
        $role = $user->roles()->get()[0];

        $rules = [
            'filter'      => ['required', Rule::in(CustomerFilterEnum::getValues() + MerchantFilterEnum::getValues())],
            'distance'    => 'required_if:filter,all|integer|min:1|max:100',
            'category_id' => 'exists:categories,id',
            'name'        => 'string|max:100',
            'barcode'     => 'string|max:20',
            'offset'      => 'integer',
        ];

        if (RolesEnum::CUSTOMER === $role->name && CustomerFilterEnum::ALL === $this->input('filter')) {
            $rules['longitude'] = 'required|numeric';
            $rules['latitude'] = 'required|numeric';
        }

        return $rules;
    }
}
