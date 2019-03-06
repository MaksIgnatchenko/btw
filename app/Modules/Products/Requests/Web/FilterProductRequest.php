<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 20.02.2019
 */

namespace App\Modules\Products\Requests\Web;


use Illuminate\Foundation\Http\FormRequest;

class FilterProductRequest extends FormRequest
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
     * Request validation rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'filter' => 'sometimes|array',
        ];
    }
}