<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RefreshTokenRequest;
use App\Http\Resources\UserResource;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService) {}

    public function register(RegistrationRequest $request)
    {
        $userRegister = $this->authService->register($request->only(['email', 'password', 'verified_token']));
        return Response::success(
            new UserResource($userRegister), 'Account created successfully.', Response::STATUS_CREATED
        );
    }

    public function login(LoginRequest $request)
    {
        $data = $this->authService->login($request->validated('email'), $request->validated('password'));

        return Response::success($data, 'Login successfully.');
    }

    public function refreshToken(RefreshTokenRequest $request)
    {
        $token = $this->authService->refreshToken($request->validated('refreshToken'));

        return Response::success($token, 'Refresh token successfully.');
    }

    public function logout(Request $request)
    {
        $this->authService->logout();

        return Response::success(null, 'Logout successfully.', Response::STATUS_NO_CONTENT);
    }

    public function getMe(Request $request)
    {
        $user = $this->authService->getMe();

        return Response::success($user, 'Get user successfully.');
    }
}
