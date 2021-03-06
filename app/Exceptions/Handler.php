<?php

namespace App\Exceptions;

use App\Modules\Users\Merchant\Models\Merchant;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     *
     * @return void
     */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        $requestPath = $request->path();

        if ($e instanceof TokenExpiredException) {
            return response()->json(['token_expired'], $e->getStatusCode());
        }
        if ($e instanceof TokenInvalidException) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        }

        if ($e instanceof NotFoundHttpException) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Not Found', 404]);
            }

            if (strpos($requestPath, 'admin/') !== false) {
                return response()->view('layouts.404_page', [], 404);
            }

            $merchant = Auth::user();
            return response()->view('layouts.merchants.404_page', [
                'merchant' => $merchant,
            ], 404);
        }

        if ($e instanceof HttpException && 403 === $e->getStatusCode()) {
            $merchant = Auth::user();
            if ($request->isJson()) {
                return response()->json(['error' => 'Not Allowed'], 403);
            }

            return response()->view('layouts.merchants.403_page', [
                'merchant' => $merchant,
            ], 403);
        }

        if ($e instanceof ModelNotFoundException) {
            if ($request->ajax()) {
                return response()->json(['error' => 'No query results for model', 404]);
            }

            if (strpos($requestPath, 'admin/') !== false) {
                return response()->view('layouts.404_page', [], 404);
            }

            $merchant = Auth::user();
            return response()->view('layouts.merchants.404_page', [
                'merchant' => $merchant,
            ], 404);
        }

        return parent::render($request, $e);
    }

    /**
     * Override of unauthenticated exception.
     *
     * @param \Illuminate\Http\Request $request
     * @param AuthenticationException $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $exception->getMessage()], 401);
        }

        $guard = array_get($exception->guards(), 0);

        switch ($guard) {
            case 'merchant':
                $login = 'index';
                break;
            default:
                $login = 'login';
        }

        return redirect()->guest(route($login));
    }
}
