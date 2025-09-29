<?php

namespace Database\Seeders;

use App\Managers\Constants;
use App\Models\Offer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        $dealers = User::where('user_type', Constants::DEALER)->get();

        foreach ($orders as $order) {
            // كل طلب ياخد 2-3 عروض من معارض مختلفة
            $selectedDealers = $dealers->random(rand(2, 3));

            foreach ($selectedDealers as $dealer) {
                Offer::create([
                    'order_id' => $order->id,
                    'user_id' => $dealer->id,
                    'price' => rand(70000, 150000),
                    'status' => Constants::PENDING,
                ]);
            }
        }
    }
}
