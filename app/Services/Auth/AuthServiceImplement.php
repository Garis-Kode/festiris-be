<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Mail;
use LaravelEasyRepository\ServiceApi;
use App\Repositories\User\UserRepository;

class AuthServiceImplement extends ServiceApi implements AuthService{

    /**
     * var mainRepository
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
      $result = $this->mainRepository->create($data);
      Mail::send('email.verified', ['token' => $result->verified_token, 'email' => $result->email], function ($message) use ($result) {
        $message->to($result->email);
        $message->subject('Verifikasi Akun');
      });
      return $result;
    }
}
