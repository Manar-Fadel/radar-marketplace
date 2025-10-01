<?php

namespace Database\Seeders;

use App\Managers\Constants;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'manar@example.com')->first();
        if (!$admin instanceof User) {
            User::create([
                'full_name' => 'Admin User',
                'email' => 'manar@example.com',
                'password' => Hash::make('112233'),
                'phone_number' => '0500000000',
                'user_type' => Constants::ADMIN,
                'is_verified_email' => true,
                'is_verified_admin' => true,
                'is_trusted' => true,
            ]);
        }


        // Bank Delegates
        User::factory()->count(5)->create([
            'user_type' => Constants::BANK_DELEGATE,
            'is_verified_email' => true,
        ]);

        // Dealers
        User::factory()->count(10)->create([
            'user_type' => Constants::DEALER,
            'is_verified_email' => true,
            'is_verified_admin' => true,
        ]);
    }
}
