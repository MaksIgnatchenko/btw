<?php

namespace App\Modules\Advert\Requests\Admin;

use App\Modules\Advert\Enums\AdvertStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdvertRequest extends FormRequest
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
            'name'   => 'required|string|max:100',
            'link'   => 'required|url|max:1000',
            'status' => ['required', Rule::in(AdvertStatusEnum::getValues())],
        ];
    }
}
