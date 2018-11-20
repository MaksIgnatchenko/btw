<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 20.11.2018
 */

namespace App\Modules\Users\Merchant\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAvatarRequest extends FormRequest
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
            'avatar' => 'required|file|image|min:50|max:' . (config('wish.storage.products.image_max_size') / 1024),
        ];
    }
}
