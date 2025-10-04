<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurCar extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'price',
        'brand_id',
        'model_id',
        'description_ar',
        'description_en',
        'mileage',
        'fuel_type',
        'transmission',
        'engine',
        'drive_type',
        'person',
        'is_slider_banner',
        'is_best_car',
        'slider_image_url',
        'main_image_url'
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'model_id');
    }
    public function images(): HasMany
    {
        return $this->hasMany(OurCarImage::class);
    }

}
