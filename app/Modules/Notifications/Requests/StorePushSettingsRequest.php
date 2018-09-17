<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.02.2018
 */

namespace App\Modules\Notifications\Requests;

use App\Modules\Rbac\Enum\RolesEnum;
use App\Modules\Users\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePushSettingsRequest extends FormRequest
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
        /** @var User $user */
        $user = Auth::user();
        $role = $user->getRoles()['name'];

        if (RolesEnum::CUSTOMER === $role) {
            return [
                'enabled'             => 'required|boolean',
                'new_posted_deal'     => 'required|boolean',
                'new_price_breaker'   => 'required|boolean',
                'redemption_reminder' => 'required|boolean',

                'category_id'   => 'sometimes|array',
                'category_id.*' => 'sometimes|exists:categories,id'
            ];
        }

        return [
            'enabled'         => 'required|boolean',
            'review'          => 'required|boolean',
            'wish_list'       => 'required|boolean',
            'new_transaction' => 'required|boolean',
        ];
    }
}
