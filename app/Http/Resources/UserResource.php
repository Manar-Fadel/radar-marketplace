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
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'user_type' => $this->user_type,
            'document_url' => $this->document_url,
            'is_verified_email' => $this->is_verified_email,
            'is_verified_admin' => $this->is_verified_admin,
            'is_trusted' => $this->is_trusted,
        ];
    }
}
