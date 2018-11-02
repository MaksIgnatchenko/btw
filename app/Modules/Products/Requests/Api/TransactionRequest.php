<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.01.2018
 */

namespace App\Modules\Products\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    use CartValidatorTrait;

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
            'amount'   => 'required|numeric',
            'noncence' => 'required|string|max:1000'
        ];
    }

    /**
     * @return Validator
     */
    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();

        $this->validatorAfter($validator);

        return $validator;
    }
}