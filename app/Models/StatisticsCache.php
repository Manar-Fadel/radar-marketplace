<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatisticsCache extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'metric_name',
        'value',
        'last_updated',
    ];
    protected $casts = [
        'last_updated' => 'datetime',
    ];
    protected array $keys = [
        'total_brands',
        'total_orders',
        'accepted_orders',
        'total_offers',
        'accepted_offers',
        'total_dealers',
        'total_bank_delegates'
    ];

    public static function getStat(string $metric_name)
    {
        return self::where('metric_name', $metric_name)->first();
    }
    public static function updateStat(string $metric_name, array $value)
    {
        return self::updateOrCreate(
            ['metric_name' => $metric_name],
            ['value' => $value, 'last_updated' => now()]
        );
    }
}
