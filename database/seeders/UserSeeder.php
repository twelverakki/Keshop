<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan menggunakan model User

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        // 1. ADMIN (Approved)
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'seller_status' => null, // Admin tidak perlu seller_status
        ]);

        // 2. SELLER APPROVED
        User::create([
            'name' => 'Toko Approved',
            'email' => 'seller_approved@mail.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
            'seller_status' => 'approved',
        ]);

        // 3. SELLER PENDING
        User::create([
            'name' => 'Toko Pending',
            'email' => 'seller_pending@mail.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
            'seller_status' => 'pending',
        ]);

        // 4. SELLER REJECTED
        User::create([
            'name' => 'Toko Rejected',
            'email' => 'seller_rejected@mail.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
            'seller_status' => 'rejected',
        ]);

        // 5. BUYER Biasa
        User::create([
            'name' => 'Buyer Biasa',
            'email' => 'buyer@mail.com',
            'password' => Hash::make('password'),
            'role' => 'buyer',
            'seller_status' => null,
        ]);
    }
}