<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 20.02.2019
 */

namespace App\Modules\Users\Http\Middleware;

use App\Modules\Users\Admin\Models\Admin;
use App\Modules\Users\Customer\Models\Customer;
use App\Modules\Users\Merchant\Models\Merchant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laracasts\Flash\Flash;

/**
 * Class UserStatusMiddleware
 * @package App\Modules\Users\Http\Middleware
 */
class UserStatusMiddleware
{

    /**
     *
     */
    protected const INACTIVE = 'inactive';
    /**
     *
     */
    protected const PENDING = 'pending';
    /**
     *
     */
    protected const ACTIVE = 'active';
    /**
     * @var array
     */
    protected $filterRoutes = [
        'transaction.token',
        'products.show',
    ];
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
        if (!$user) {
            return $next($request);
        }
        if ($user instanceof Admin) {
            return $next($request);
        }

        switch ($user->status) {
            case self::INACTIVE:
                return $this->inactiveResponse($user);
            /** @noinspection PhpMissingBreakStatementInspection */
            case self::PENDING:
                if (!$this->requestAllowed($request)) {
                    return $this->pendingResponse($user);
                }
            // no break
            default:
                return $next($request);
        }
    }

    /**
     * @param $user
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function inactiveResponse($user)
    {
        Auth::logout();

        if ($user instanceof Customer) {
            return response()->json([
                'message' => __('auth.account_inactive'),
            ], 403);
        }

        return redirect('/login')->withErrors(__('auth.account_inactive'));
    }

    /**
     * @param $user
     * @return \Illuminate\Http\JsonResponse|void
     */
    protected function pendingResponse($user)
    {
        if ($user instanceof Customer) {
            return response()->json([
                'message' => __('auth.account_pending'),
            ], 403);
        }

        return abort(403, __('auth.account_pending'));
    }

    /**
     * @param Request $request
     * @return bool
     */
    protected function requestAllowed(Request $request) : bool
    {
        $routeName = $request->route()->getAction()['as'] ?? '';
        if (in_array($routeName, $this->filterRoutes, true)) {
            return false;
        }

        if ('GET' !== $request->getMethod()) {
            return false;
        }

        return true;
    }
}