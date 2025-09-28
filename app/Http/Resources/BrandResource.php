<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            'name' => $this->name,

            'brand_name_ar' => $this->brand_name_ar,
            'brand_name_en' => $this->brand_name_en,
            'logo_url' => $this->logo_url,
        ];
    }
}
