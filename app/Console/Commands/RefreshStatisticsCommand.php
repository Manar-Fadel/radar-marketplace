<?php

namespace App\Console\Commands;

use App\Managers\Constants;
use App\Models\Brand;
use Illuminate\Console\Command;
use App\Models\StatisticsCache;
use App\Models\Order;
use App\Models\User;
use App\Models\Offer;

class RefreshStatisticsCommand extends Command
{
    protected $signature = 'stats:refresh';
    protected $description = 'حساب وتحديث الإحصائيات المخزنة في StatisticsCache';

    public function handle(): int
    {
        $this->info("🔄 جاري تحديث الإحصائيات...");

        StatisticsCache::updateStat('total_brands', [
            'count' => Brand::count(),
        ]);
        StatisticsCache::updateStat('total_orders', [
            'count' => Order::count(),
        ]);
        StatisticsCache::updateStat('accepted_orders', [
            'count' => Order::where('status', Constants::ACCEPTED)->count(),
        ]);
        StatisticsCache::updateStat('total_offers', [
            'count' => Offer::count(),
        ]);
        StatisticsCache::updateStat('accepted_offers', [
            'count' => Offer::where('status', Constants::ACCEPTED)->count(),
        ]);
        StatisticsCache::updateStat('total_dealers', [
            'count' => User::where('user_type', Constants::DEALER)->count(),
        ]);
        StatisticsCache::updateStat('total_bank_delegates', [
            'count' => User::where('user_type', Constants::BANK_DELEGATE)->count(),
        ]);

        $this->info("✅ تم تحديث الإحصائيات بنجاح!");
        return 0;
    }
}
