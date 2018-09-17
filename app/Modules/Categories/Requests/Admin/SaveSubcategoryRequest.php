<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 21.11.2017
 */

namespace App\Modules\Categories\Requests\Admin;

class SaveSubcategoryRequest extends CategoriesRequest
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
    public function rules()
    {
        return [
            'parent_category_id' => 'required|exists:categories,id',

            'name'     => 'required|min:4|max:100',
            'is_final' => 'sometimes|boolean',
        ];
    }
}
