<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            "Fashion Pria",
            "Fashion Wanita",
            "Kecantikan & Perawatan Diri",
            "Elektronik",
            "Perlengkapan Rumah Tangga",
            "Hobi & Koleksi",
            "Makanan & Minuman",
            "Ibu & Bayi",
            "Otomotif",
            "Olahraga & Aktivitas Luar Ruang",
            "Kesehatan",
            "Perhiasan & Aksesori",
            "Mainan Anak & Edukasi",
            "Perlengkapan Kantor & Alat Tulis",
            "Perlengkapan Hewan Peliharaan"
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat),
                'image' => null,
            ]);
        }
    }
}