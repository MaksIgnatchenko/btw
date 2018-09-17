<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.02.2018
 */

namespace App\Modules\Notifications\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetNotificationsRequest extends FormRequest
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
            'offset' => 'sometimes|integer',
        ];
    }
}
