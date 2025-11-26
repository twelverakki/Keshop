<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@ecom.com'],
            [
                'name' => 'Super Admin',
                'password' => 'password',
                'role' => 'admin',
                'email_verified_at' => now(), // Verifikasi email/Status Approved (Admin)
            ]
        );

        // 2. PENGGUNA SELLER (Total 5 Akun)

        // a. Seller Utama (APPROVED)
        User::firstOrCreate(
            ['email' => 'seller@ecom.com'],
            [
                'name' => 'Verified Store',
                'password' => 'password',
                'role' => 'seller',
                'email_verified_at' => now(), // Status Approved
                ]
            );

        // b. Seller Menunggu/Ditolak (PENDING/REJECTED) - 4 Akun
        User::factory()->count(4)->create([
            'role' => 'seller',
            'password' => 'password',
            'email_verified_at' => null, // Status Pending/Rejected
        ]);

        // 3. PENGGUNA BUYER (Total 4 Akun)

        // Buyer juga dapat memiliki email_verified_at NULL (tidak diverifikasi)
        User::factory()->count(4)->create([
            'role' => 'buyer',
            'password' => 'password',
            'email_verified_at' => now(),
        ]);
    }
}
