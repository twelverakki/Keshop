<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID Pembeli yang sudah ada (ID 7, 8, 9 adalah 'buyer' di users.sql)
        $buyerIds = [7, 8, 9];

        // Buat 5 pesanan dengan status 'completed' agar bisa di-review
        for ($i = 0; $i < 5; $i++) {
            Order::create([
                'user_id' => $buyerIds[array_rand($buyerIds)], // Pilih pembeli acak
                'status' => 'completed',
                'total_price' => rand(100, 1000) * 1000, // Harga acak
                'address' => 'Jl. Dummy No. ' . rand(1, 50) . ', Kota Contoh',
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}