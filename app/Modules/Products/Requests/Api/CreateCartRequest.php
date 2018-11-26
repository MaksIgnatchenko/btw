<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.01.2018
 */

namespace App\Modules\Products\Requests\Api;

use App\Modules\Bidding\Repositories\BidRepository;
use App\Modules\Products\Models\Cart;
use Illuminate\Foundation\Http\FormRequest;

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
            'quantity' => 'sometimes|integer|min:' . Cart::PRODUCT_MIN_QUANTITY . '|max:99',
        ];
    }
}
