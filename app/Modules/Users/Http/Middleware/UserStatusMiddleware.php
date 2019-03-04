<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 20.02.2019
 */

namespace App\Modules\Users\Http\Middleware;

use App\Modules\Users\Admin\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laracasts\Flash\Flash;

class UserStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param         $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();


        if ($user instanceof Admin) {
            return $next($request);
        }

        if ($this->isInactive($user)) {
            Auth::logout();
            return redirect('/login');
        }

        if ($this->isPending($user) && !$this->isGet($request)) {
            return redirect()->back();
        }

        return $next($request);
    }

    /**
     * @param Authenticatable $user
     * @return bool
     */
    protected function isInactive(Authenticatable $user): bool
    {
        return 'inactive' === $user->status;
    }

    /**
     * @param Authenticatable $user
     * @return bool
     */
    protected function isPending(Authenticatable $user) : bool
    {
        return 'pending' === $user->status;
    }

    /**
     * @param Request $request
     * @return bool
     */
    protected function isGet(Request $request) : bool
    {
        return 'GET' === $request->getMethod();
    }
}