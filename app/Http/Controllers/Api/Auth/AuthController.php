<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegistrationRequest;

class AuthController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @throws Throwable
     */
    public function register(RegistrationRequest $request)
    {
        $userApplicant = DB::transaction(function () use ($request) {
            return $this->authRepository->store($request);
        });

        $userApplicant->refresh();
        $userApplicant->load('role');

        return Response::success(
            new UserResource($userApplicant), 'Account created successfully.', Response::STATUS_CREATED
        );
    }
}
