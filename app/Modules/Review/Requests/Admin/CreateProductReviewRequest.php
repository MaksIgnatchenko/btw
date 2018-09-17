<?php

namespace App\Modules\Review\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Review\Models\ProductReview;

class CreateProductReviewRequest extends FormRequest
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
    public function rules(): array
    {
        return ProductReview::$rules;
    }
}
