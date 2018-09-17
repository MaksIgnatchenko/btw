<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 27.11.2017
 */

namespace App\Modules\Users\Http\Controllers\Api;

use App\Modules\Users\Models\User;
use Illuminate\Http\JsonResponse;

trait AuthResponseTrait
{
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'token'      => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     * @param User $user
     *
     * @return JsonResponse
     */
    protected function respondWithTokenFull(string $token, User $user): JsonResponse
    {
        return response()->json([
            'token'      => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
            'roles'      => $user->getRoles(),
            'status'     => $user->getStatus(),
        ]);
    }
}
