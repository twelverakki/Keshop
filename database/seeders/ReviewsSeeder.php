<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil semua Order Items yang sudah ada
        $orderItems = OrderItem::with('order')->get();

        $comments = [
            'Produknya bagus banget, sesuai deskripsi!',
            'Pengiriman cepat, kualitas barang oke, recommended seller!',
            'Cukup puas, tapi pengemasan kurang rapi.',
            'Harga terjangkau, tapi hasilnya biasa saja.',
            'Best purchase tahun ini, pasti beli lagi!',
        ];

        // 2. Buat ulasan berdasarkan setiap Order Item yang unik
        foreach ($orderItems as $item) {
            $userId = $item->order->user_id;
            $productId = $item->product_id;

            // Pastikan user belum pernah review produk ini sebelumnya
            if (!Review::where('user_id', $userId)->where('product_id', $productId)->exists()) {

                Review::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'rating' => rand(3, 5), // Rating cenderung positif
                    'comment' => $comments[array_rand($comments)],
                    'created_at' => now()->subDays(rand(1, 20)),
                ]);
            }
        }
    }
}