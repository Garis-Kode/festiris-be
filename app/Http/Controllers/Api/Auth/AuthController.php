<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\Response;
use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\Auth\RegistrationRequest;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegistrationRequest $request)
    {
        $userRegister = $this->authService->register($request->only(['email', 'password']));
        return Response::success(
            new UserResource($userRegister), 'Account created successfully.', Response::STATUS_CREATED
        );
    }
}
