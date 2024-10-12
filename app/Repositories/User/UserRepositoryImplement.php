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

    public function findByEmail(string $email): User
    {
        return $this->model->where('email', $email)->first();
    }

    public function registrationCompleted(string $verifiedToken, string $userUuid, string $firstName, string $lastName, string $gender): ?User
    {
        $user = $this->model->where('verified_token', $verifiedToken)
                        ->where('uuid', $userUuid)
                        ->first();
        if ($user) {
            $user->update([
                'first_name' => $firstName,
                'last_name'  => $lastName,
                'gender'     => $gender,    
                'email_verified_at' => now(),
                'verified_token' => null
            ]);
            return $user;
        }
        return null;
    }

}
