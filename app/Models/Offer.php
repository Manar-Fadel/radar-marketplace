<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'offer_number',
        'order_id',
        'user_id',
        'price',
        'status',
    ];
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($offer) {
            if (!$offer->offer_number) {
                $year = now()->format('y');
                $month = now()->format('m');
                $day = now()->format('d');
                $prefix = "OFF-{$year}-{$month}-{$day}-";

                $lastOffer = self::whereYear('created_at', now()->year)
                    ->whereMonth('created_at', now()->month)
                    ->latest('id')
                    ->first();

                $nextNumber = $lastOffer
                    ? intval(substr($lastOffer->offer_number, -4)) + 1
                    : 1;

                $offer->offer_number = $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
