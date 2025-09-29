<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['brand_name_ar' => 'تويوتا', 'brand_name_en' => 'Toyota', 'logo_url' => '/images/brands/toyota.png'],
            ['brand_name_ar' => 'نيسان', 'brand_name_en' => 'Nissan', 'logo_url' => '/images/brands/nissan.png'],
            ['brand_name_ar' => 'هونداي', 'brand_name_en' => 'Hyundai', 'logo_url' => '/images/brands/hyundai.png'],
            ['brand_name_ar' => 'كيا', 'brand_name_en' => 'Kia', 'logo_url' => '/images/brands/kia.png'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
