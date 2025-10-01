<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
{
    protected $model = Offer::class;

    public function definition()
    {
        return [
            'order_id' => Order::inRandomOrder()->first()->id ?? Order::factory(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'price' => $this->faker->numberBetween(50000, 200000),
            'status' => $this->faker->randomElement(['active', 'cancelled', 'accepted', 'rejected']),
            'offer_number' => 'OFF-' . now()->format('y-m') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
        ];
    }
}
