<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.02.2018
 */

namespace App\Modules\Csv\Requests;

use App\Modules\Csv\Enums\CsvGeneratorTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GenerateCsvRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'type'      => ['required', Rule::in(CsvGeneratorTypeEnum::getValues())],
            'date_from' => 'required|date',
            'date_to'   => 'required|date',
        ];
    }
}
