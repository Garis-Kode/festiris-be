<?php

namespace App\Services\Auth;

interface AuthService
{
    /**
     * Create new user
     *
     * @param  array|mixed  $data
     * @return array|mixed
     */
    public function register($data);

    public function login(string $email, string $password);

    public function refreshToken(string $refreshToken);
}
