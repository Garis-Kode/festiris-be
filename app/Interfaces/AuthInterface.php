<?php

namespace App\Interfaces;

use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\User;

interface AuthInterface
{
    /**
     * Store a new user's registration.
     *
     * @param RegistrationRequest $request
     *
     * @return User
     */
    public function store(RegistrationRequest $request): User;

}