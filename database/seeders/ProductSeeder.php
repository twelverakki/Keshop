<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada user seller dulu
        $seller = User::firstOrCreate(
            ['email' => 'seller@hiyoucan.com'],
            [
                'name' => 'Official Seller',
                'password' => bcrypt('password'),
                'role' => 'seller',
                'email_verified_at' => now(),
            ]
        );

        $products = [
            ['name' => 'SilkSculpt Serum', 'price' => 350000, 'cat' => 1, 'img' => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?q=80&w=1000'],
            ['name' => 'SilkSkin Serum', 'price' => 480000, 'cat' => 1, 'img' => 'https://images.unsplash.com/photo-1601049541289-9b1b7bbbfe19?q=80&w=1000'],
            ['name' => 'Argan Glow Hair Oil', 'price' => 630000, 'cat' => 3, 'img' => 'https://images.unsplash.com/photo-1629198688000-71f23e745b6e?q=80&w=1000'],
            ['name' => 'Smooth Foundation', 'price' => 200000, 'cat' => 2, 'img' => 'https://images.unsplash.com/photo-1616683693504-3ea7e9ad6fec?q=80&w=1000'],
            ['name' => 'Herbal Haven Soap', 'price' => 100000, 'cat' => 5, 'img' => 'https://images.unsplash.com/photo-1608248597279-f99d160bfbc8?q=80&w=1000'],
            ['name' => 'HydraLuxe Serum', 'price' => 200000, 'cat' => 1, 'img' => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?q=80&w=1000'],
            ['name' => 'OceanMist Moisturizer', 'price' => 200000, 'cat' => 1, 'img' => 'https://images.unsplash.com/photo-1611930022073-b7a4ba5fcccd?q=80&w=1000'],
            ['name' => 'Velvet Rose Perfume', 'price' => 850000, 'cat' => 4, 'img' => 'https://images.unsplash.com/photo-1598440947619-2c35fc9aa908?q=80&w=1000'],
        ];

        foreach ($products as $item) {
            Product::create([
                'seller_id' => $seller->id,
                'category_id' => $item['cat'], // ID 1-5 sesuai urutan CategorySeeder
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => 'Produk organik berkualitas tinggi untuk perawatan harian Anda.',
                'price' => $item['price'],
                'stock' => 50,
                'image' => $item['img'],
                'is_active' => true,
            ]);
        }
    }
}