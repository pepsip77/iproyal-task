<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiLoginGetRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;

class ApiLogin extends Controller
{
    /**
     * @throws AuthenticationException
     */
    public function __invoke(ApiLoginGetRequest $request, AuthManager $authManager, User $userModel): JsonResponse
    {
        $params = $request->validated();

        if (!$authManager->attempt($params)) {
            throw new AuthenticationException();
        }

        $user = $userModel->newQuery()
            ->where('email', '=', $params['email'])
            ->first();

        if (!$user) {
            throw new AuthenticationException();
        }

        $user->tokens()->delete();

        return response()->json([
            'token' => $user->createToken('access')->plainTextToken,
        ]);
    }
}
