<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition()
    {
        return [
            'name_ar' => $this->faker->word() . ' عربية',
            'name_en' => $this->faker->company(),
            'logo' => 'brands/default.png', // صورة افتراضية
        ];
    }
}
