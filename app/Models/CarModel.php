<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'model_name_ar',
        'model_name_en',
        'brand_id',
    ];

    protected function getNameAttribute(): ?string
    {
        $locale = app()->getLocale();
        return  ($locale == 'en') ? $this->model_name_en : $this->model_name_ar;
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }


}
