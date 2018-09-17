<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 21.11.2017
 */

namespace App\Modules\Categories\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SaveRootCategoryRequest extends FormRequest
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
            'name' => 'required|min:4|max:100',
        ];
    }
}
