<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthTokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'accessToken' => $this->access_token,
            'refreshToken' => $this->refresh_token,
            'expiresIn' => $this->expires_in,
            'tokenType' => $this->token_type,
        ];
    }
}
