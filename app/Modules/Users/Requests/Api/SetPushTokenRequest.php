<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.12.2017
 */

namespace App\Modules\Users\Requests\Api;

use App\Modules\Users\Enums\DeviceTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class SetPushTokenRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'push_token'  => 'required|string|max:255',
            'device_type' => 'required|in:' . DeviceTypeEnum::toString(),
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
