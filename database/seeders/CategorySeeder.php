<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        $categories = ['Elektronik', 'Pakaian Pria', 'Peralatan Rumah Tangga', 'Makanan & Minuman', 'Otomotif'];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'slug' => Str::slug($category), // Membuat slug dari nama kategori
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}