<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.01.2018
 */

namespace App\Modules\Products\Requests\Api;

use App\Modules\Products\Models\Product;
use App\Modules\Products\Repositories\CartRepository;
use App\Modules\Users\Customer\Models\Customer;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CheckCartRequest extends FormRequest
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
        return [];
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
