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
            'Minuman Segar',
            'Makanan Ringan (Camilan)',
            'Makanan Instan',
            'Bahan Pokok & Sembako',
            'Produk Olahan Susu & Roti',
            'Perawatan Rambut & Tubuh',
            'Perawatan Wajah & Kulit',
            'Kebutuhan Sanitasi',
            'Wewangian',
            'Pencuci Pakaian',
            'Pembersih Rumah',
            'Pengendali Hama',
            'Kebutuhan Bayi',
            'Produk Kesehatan Ringan',
            'Kebutuhan Imbuhan',
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat),
            ]);
        }
    }
}
