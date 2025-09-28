<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'message_ar' => $this->message_ar,
            'message_en' => $this->message_en,
            'user_id' => $this->user_id,
            'is_read' => $this->is_read,
            'created_at' => $this->created_at
        ];
    }
}
