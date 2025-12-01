<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderIds = Order::pluck('id');
        // Ambil ID Produk yang ada (ID 1 sampai 21 dari products.sql)
        $productIds = range(1, 21);

        // Buat 15 Order Items
        for ($i = 0; $i < 15; $i++) {
            $randomOrderId = $orderIds->random();
            $randomProductId = $productIds[array_rand($productIds)];

            OrderItem::create([
                'order_id' => $randomOrderId,
                'product_id' => $randomProductId,
                'quantity' => rand(1, 3),
                'price' => rand(50000, 500000), // Harga snapshot
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}