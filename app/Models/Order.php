<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'order_number',
        'user_id',
        'brand_id',
        'description',
        'status',
        'accepted_offer_id',
        'accepted_dealer_id',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }
    public function images(): HasMany
    {
        return $this->hasMany(OrderImage::class);
    }
    public function acceptedOffer(): BelongsTo
    {
        return $this->belongsTo(Offer::class, 'accepted_offer_id');
    }
    public function acceptedDealer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'accepted_dealer_id');
    }
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($order) {
            if (!$order->order_number) {
                $year = now()->format('y');
                $month = now()->format('m');
                $day = now()->format('d');
                $prefix = "ORD-{$year}-{$month}-{$day}-";

                $lastOrder = self::whereYear('created_at', now()->year)
                    ->whereMonth('created_at', now()->month)
                    ->latest('id')
                    ->first();

                $nextNumber = $lastOrder
                    ? intval(substr($lastOrder->order_number, -4)) + 1
                    : 1;

                $order->order_number = $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
