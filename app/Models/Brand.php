<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'brand_name_ar',
        'brand_name_en',
        'logo_url',
    ];
    protected function getNameAttribute(): ?string
    {
        $locale = app()->getLocale();
        return  ($locale == 'en') ? $this->brand_name_en : $this->brand_name_ar;
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'brand_id');
    }

}
