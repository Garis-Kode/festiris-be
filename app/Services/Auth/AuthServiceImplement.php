<?php

namespace App\Services\Auth;

use Exception;
use App\Models\User;
use App\Helpers\Response;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use LaravelEasyRepository\ServiceApi;
use App\Exceptions\UnauthorizedException;
use App\Http\Resources\AuthTokenResource;
use App\Repositories\User\UserRepository;
use App\Exceptions\UnexpectedErrorException;
use Illuminate\Http\Client\ConnectionException;

class AuthServiceImplement extends ServiceApi implements AuthService
{
    public function __construct(private readonly UserRepository $mainRepository) {}

    /**
     * Create new user data
     *
     * @param  array|mixed  $data
     * @return array|mixed
     */
    public function register(string $email, string $password, string $verifiedToken)
    {
        try {
            $data = $this->mainRepository->register($email, $password, $verifiedToken, $email);
            Mail::send('email.verified', ['token' => $verifiedToken, 'userId' => $data->uuid, 'email' => $email], function ($message) use ($email) {
                $message->to($email);
                $message->subject('Verifikasi Akun');
            });
            return $data;
        } catch (Exception $exception) {
            throw new UnexpectedErrorException($exception);
        }
    }

    /**
     *  Log the user in.
     *
     * @throws ConnectionException
     * @throws UnauthorizedException
     */
    public function login(string $email, string $password): array
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            $response = Http::asForm()->post('http://nginx/oauth/token', [
                'grant_type' => 'password',
                'client_id' => config('passport.grant_client.id'),
                'client_secret' => config('passport.grant_client.secret'),
                'username' => $email,
                'password' => $password,
                'scope' => '',
            ]);

            return [
                'token' => new AuthTokenResource(json_decode($response->body(), false)),
                'user' => new UserResource($user),
            ];
        }

        throw new UnauthorizedException('Invalid email or password');
    }

    /**
     * Refresh the token.
     *
     * @throws ConnectionException
     * @throws UnauthorizedException
     * @throws UnexpectedErrorException
     */
    public function refreshToken(string $refreshToken): array
    {
        $response = Http::asForm()->post('http://nginx/oauth/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id' => config('passport.grant_client.id'),
            'client_secret' => config('passport.grant_client.secret'),
            'scope' => '',
        ]);

        if ($response->successful()) {
            return [
                'token' => new AuthTokenResource(json_decode($response->body(), false)),
            ];
        } else {
            if ($response->status() === Response::STATUS_UNAUTHORIZED) {
                throw new UnauthorizedException('Invalid refresh token');
            } else {
                throw new UnexpectedErrorException;
            }
        }
    }

    /**
     * Log the user out.
     */
    public function logout(): void
    {
        $user = Auth::user();
        $user->tokens()->delete();
    }

    /**
     * Get the authenticated user.
     */
    public function getMe(): UserResource
    {
        $user = Auth::user();

        return new UserResource($user);
    }
}
