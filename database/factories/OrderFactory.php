<?php

namespace Database\Factories;

use App\Managers\Constants;
use App\Models\Order;
use App\Models\User;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'brand_id' => Brand::inRandomOrder()->first()->id ?? Brand::factory(),
            'description' => $this->faker->sentence(6),
            'status' => $this->faker->randomElement([Constants::PENDING, Constants::CANCELLED]),
            'accepted_offer_id' => null,
            'accepted_dealer_id' => null,
            'order_number' => 'ORD-' . now()->format('y-m') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
        ];
    }
}
