<?php

namespace App\Services\Auth;

use LaravelEasyRepository\BaseService;

interface AuthService extends BaseService{

    /**
     * Create new user
     * @param array|mixed $data
     * @return array|mixed
     */
    public function register($data);
}
