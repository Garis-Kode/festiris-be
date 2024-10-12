<?php

namespace App\Repositories\User;

use App\Models\User;
use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
    public function register(string $email, string $password, string $verifiedToken) : User;

    public function findByEmail(string $email) : User;

    public function registrationCompleted(string $verifiedToken, string $userUuid, string $firstName, string $lastName, string $gender): ?User;
}
