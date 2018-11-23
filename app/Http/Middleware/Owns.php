<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Modules\Users\Merchant\Models\Merchant;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Owns
{
    /**
     * Handle an incoming request.
     *
     * @param         $request
     * @param Closure $next
     * @param string  $relatedObjectName
     *
     * @return mixed
     */
    public function handle($request, Closure $next, string $relatedObjectName)
    {
        $user = Auth::user();

        if (!$user
            || !method_exists($user, 'owns')
            || !$user->owns($request->$relatedObjectName, $this->getOwnerIdColumnName($user))) {
            abort(404);
        }

        return $next($request);
    }

    /**
     * @param Authenticatable $user
     * @return string
     */
    protected function getOwnerIdColumnName(Authenticatable $user): string
    {
        if ($user instanceof Merchant) {
            return 'merchant_id';
        }

        return 'customer_id';
    }
}
