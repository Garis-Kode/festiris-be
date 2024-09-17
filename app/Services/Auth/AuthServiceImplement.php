<?php

namespace App\Services\Auth;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\User\UserRepository;

class AuthServiceImplement extends ServiceApi implements AuthService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(UserRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    /**
     * Create new user data
     * @param array|mixed $data
     * @return array|mixed
     */
    public function register($data){
      return $this->mainRepository->create($data);
    }
}
