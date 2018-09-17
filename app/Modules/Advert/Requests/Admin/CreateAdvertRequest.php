<?php

namespace App\Modules\Advert\Requests\Admin;

use App\Modules\Advert\Enums\AdvertStatusEnum;
use App\Modules\Advert\Models\Advert;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAdvertRequest extends FormRequest
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
            'image'  => 'required|image|mimes:jpg,jpeg,png|dimensions:width=' . Advert::IMAGE_WIDTH . ',height=' . Advert::IMAGE_HEIGHT,
            'status' => ['required', Rule::in(AdvertStatusEnum::getValues())],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'image.dimensions' => 'Wrong dimensions. Needed width - ' . Advert::IMAGE_WIDTH . ', needed height - ' . Advert::IMAGE_HEIGHT,
        ];
    }
}
