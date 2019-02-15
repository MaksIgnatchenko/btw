<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 13.02.2019
 */

namespace App\Modules\Reviews\Requests;

use App\Modules\Orders\Models\Order;
use App\Modules\Reviews\Rules\NotRatedOrderRule;
use App\Modules\Reviews\Rules\PickedUpOrderRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int order_id
 * @property int rating
 * @property string comment
 * @property mixed merchant_rating
 * @property mixed product_rating
 * @property mixed merchant_comment
 * @property mixed product_comment
 */
class CreateReviewRequest extends FormRequest
{


    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'merchant_rating' => 'required|integer|min:1|max:5',
            'product_rating'  => 'required|integer|min:1|max:5',
            'order_id'        => [
                'required',
                'integer',
                new NotRatedOrderRule(),
                new PickedUpOrderRule()
            ]
        ];
    }
}
