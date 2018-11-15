<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
            || !$user->owns($request->$relatedObjectName, 'customer_id')) {
            abort(404);
        }

        return $next($request);
    }
}
