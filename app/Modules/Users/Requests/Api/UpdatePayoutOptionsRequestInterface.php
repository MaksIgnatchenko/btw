<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.12.2017
 */

namespace App\Modules\Users\Requests\Api;

use App\Modules\Users\Enums\PaymentOptionsEnum;
use App\Modules\Users\Requests\ModifyPaymentOptionsRequestInterface;
use App\Modules\Users\RequestsTraits\ValidatePaymentOptionsTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePayoutOptionsRequestInterface extends FormRequest implements ModifyPaymentOptionsRequestInterface
{
    use ValidatePaymentOptionsTrait;

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'payment_option' => 'required|in:' . implode(',', PaymentOptionsEnum::getValues()),
        ];
    }

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
    public function messages(): array
    {
        $messages = [];

        $messages['wire_aba_number.regex'] = 'ABA number should contain 9 digits';

        return $messages;
    }
}
