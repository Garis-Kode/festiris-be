<?php

namespace App\Services\Auth;

use App\Models\User;
use LaravelEasyRepository\BaseService;

interface AuthService extends BaseService
{
    public function register(string $email, string $password, string $verifiedToken);

    public function registrationCompleted(string $verifiedToken, string $userUuid, string $firstName, string $lastName, string $gender);

    public function resendRegistrationMail(string $email);

    public function login(string $email, string $password);

    public function refreshToken(string $refreshToken);
}
