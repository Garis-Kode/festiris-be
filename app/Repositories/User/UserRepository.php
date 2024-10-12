<?php

namespace App\Repositories\User;

use App\Models\User;
use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
    public function register(string $email, string $password, string $verifiedToken) : User;

    /**
     * find data by email
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email) : User;
}
