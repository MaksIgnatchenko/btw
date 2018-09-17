<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 23.11.2017
 */


namespace App\Modules\Categories\Requests\Admin;

class UpdateCategoryRequest extends CategoriesRequest
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
