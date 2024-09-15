<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Interfaces\AuthInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\Auth\RegistrationRequest;

class AuthController extends Controller
{
    private AuthInterface $authRepository;

    public function __construct(AuthInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * Store a newly created resource in storage.
     * @throws Throwable
     */
    public function register(RegistrationRequest $request)
    {
        $userRegistration = DB::transaction(function () use ($request) {
            return $this->authRepository->store($request);
        });

        return Response::success(
            new UserResource($userRegistration), 'Account created successfully.', Response::STATUS_CREATED
        );
    }
}
