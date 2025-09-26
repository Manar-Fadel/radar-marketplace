<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'order_number'          => $this->order_number,
            'user_id'               => $this->user_id,
            'brand_id'              => $this->brand_id,
            'brand_name'            => $this->brand->name,
            'description'           => $this->description,
            'status'                => $this->status,
            'accepted_offer_id'     => $this->accepted_offer_id,
            'accepted_dealer_id'    => $this->accepted_dealer_id,
            'images'                => $this->images,
        ];
    }
}
