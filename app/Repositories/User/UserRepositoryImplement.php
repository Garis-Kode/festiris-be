<?php

namespace App\Repositories\User;

use App\Models\User;
use LaravelEasyRepository\Implementations\Eloquent;

class UserRepositoryImplement extends Eloquent implements UserRepository
{
    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     *
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function register(string $email, string $password, string $verifiedToken): User
    {
        return $this->model->create([
            'email' => $email,
            'password' => $password, // Pastikan password di-hash
            'verified_token' => $verifiedToken
        ]);
    }

}
