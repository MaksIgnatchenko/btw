<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 11.12.2017
 */

namespace App\Http\Middleware;

use App\Modules\Rbac\Enum\RolesEnum;
use App\Modules\Users\Enums\CustomerStatusEnum;
use App\Modules\Users\Enums\MerchantStatusEnum;
use App\Modules\Users\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class ActiveUser
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        /** @var User $user */
        $user = Auth::user();
        $status = $user->getStatus();

        if (MerchantStatusEnum::PENDING === $status) {
            return response()->json(['message' => 'This action is disabled due to the "Pending" status of your account. For the further information, please contact the administrator.'],
                401);
        }
        if (MerchantStatusEnum::NOT_ACTIVE === $status) {
            return response()->json(['message' => 'Due to several violations, your status was changed to inactive. For the further information, please contact the administrator.'],
                401);
        }

        return $next($request);
    }
}
