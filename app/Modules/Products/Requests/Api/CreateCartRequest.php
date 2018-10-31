<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.01.2018
 */

namespace App\Modules\Products\Requests\Api;

use App\Modules\Bidding\Repositories\BidRepository;
use App\Modules\Products\Enums\CartDeliveryOptionEnum;
use App\Modules\Products\Enums\CartSourceEnum;
use App\Modules\Products\Repositories\ProductRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class CreateCartRequest extends FormRequest
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
        return [
            'product_id' => 'required|exists:products,id',
        ];
    }
}
