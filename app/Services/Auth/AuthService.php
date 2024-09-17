<?php

namespace App\Services\Auth;

interface AuthService{

    /**
     * Create new user
     * @param array|mixed $data
     * @return array|mixed
     */
    public function register($data);
}
