<?php

namespace App\Repositories\Public;

use App\Services\AvatarService;
use Carbon\Carbon;
use App\Models\User;
use App\Helpers\Response;
use App\Traits\MapFields;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use App\Services\UploadService;
use App\Services\FrontendService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Interfaces\AuthInterface;
use App\Http\Requests\Auth\RegistrationRequest;

class AuthRepository implements AuthInterface
{
    /**
     * @var User
     */
    protected User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * Store a new user.
     *
     * @param RegistrationRequest $request
     * @return User
     * @throws Exception
     */
    public function store(RegistrationRequest $request): User
    {
        $input = $this->mapFields($request->mapFields, $request->validated());
        $user = $this->userModel->create($input);

        return $user;
    }

}