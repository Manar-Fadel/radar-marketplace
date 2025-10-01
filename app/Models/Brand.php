<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;

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
    public function getLogoUrlAttribute($value): string
    {
        if ($value) {

            // check if image in GCS return it, else load it local,
            if(strpos($value, "/tashleeh_bucket_1/") !== false){
                return $value;
            }else{
                if(strpos($value, "uploads/") !== false){
                    return URL::asset("storage/".$value);

                }else{
                    return $value;
                }
            }
        }
        return asset("media/logos/car_make.PNG"); // 80X80 default logo icon
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'brand_id');
    }
    public function models(): HasMany
    {
        return $this->hasMany(CarModel::class, 'brand_id');
    }

}
