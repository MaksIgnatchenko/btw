<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 26.01.2018
 */

namespace App\Modules\Advert\Requests\Admin;

use App\Modules\Advert\Models\AdvertConfig;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdvertModeRequest extends FormRequest
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
            'value' => ['required', Rule::in([AdvertConfig::ADMOB_MODE, AdvertConfig::CUSTOM_MODE])],
        ];
    }
}
