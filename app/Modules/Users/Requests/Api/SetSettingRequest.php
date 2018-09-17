<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 28.11.2017
 */

namespace App\Modules\Users\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SetSettingRequest extends FormRequest
{
    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'setting' => 'required|string|max:100',
            'value'   => 'required|boolean',
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
