<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */


namespace App\Modules\Categories\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetCategoriesRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'parentId' => 'exists:categories,id',
        ];
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
