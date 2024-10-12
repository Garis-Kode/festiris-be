<?php

namespace App\Services\Auth;

use LaravelEasyRepository\BaseService;

interface AuthService extends BaseService
{
    public function register(string $email, string $password, string $verifiedToken);

    public function login(string $email, string $password);

    public function refreshToken(string $refreshToken);
}
