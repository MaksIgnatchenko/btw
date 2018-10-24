<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 19.10.2018
 */

namespace App\Modules\Users\Merchant\Requests;

use App\Modules\Users\Merchant\Enums\GeographyObjectTypesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GeographyDataRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'parent_id' => 'required|integer',
            'data_type' => 'required|' . Rule::in(GeographyObjectTypesEnum::toArray()),
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