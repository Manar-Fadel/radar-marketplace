<?php

namespace Database\Seeders;

use App\Managers\Constants;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bankDelegates = User::where('user_type', Constants::BANK_DELEGATE)->get();
        $dealers = User::where('user_type', Constants::DEALER)->get();
        $brands = Brand::all();

        foreach ($bankDelegates as $delegate) {
            Order::create([
                'user_id' => $delegate->id,
                'brand_id' => $brands->random()->id,
                'description' => 'طلب سيارة ' . $brands->random()->brand_name_ar . ' موديل 2025 أبيض',
                'status' => Constants::PENDING,
            ]);
        }

        foreach ($dealers as $dealer) {
            Order::create([
                'user_id' => $dealer->id,
                'brand_id' => $brands->random()->id,
                'description' => 'طلب سيارة ' . $brands->random()->brand_name_ar . ' موديل 2024 أسود',
                'status' => Constants::PENDING,
            ]);
        }
    }
}
