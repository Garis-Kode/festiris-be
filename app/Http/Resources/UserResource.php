<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'firtsName' => $this->first_name,
            'lastName' => $this->last_name,
            'gender' => $this->gender,
            'isActive' => $this->is_active,
            'email' => $this->email,
            'createdAt' => $this->created_at?->format('c'),
            'updatedAt' => $this->updated_at?->format('c'),
            // 'profilePicture' => $this->photo_path ? $this->getDocumentUrl($this->photo_path) : null,
        ];
    }
}
