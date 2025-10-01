<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurCarImage extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function car(): BelongsTo
    {
        return $this->belongsTo(OurCar::class, 'car_id');
    }
}
