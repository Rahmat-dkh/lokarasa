<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Snack', 'slug' => 'snack', 'description' => 'Aneka cemilan khas daerah.'],
            ['name' => 'Lauk & Sambal', 'slug' => 'lauk-sambal', 'description' => 'Lauk pauk dan sambal autentik.'],
            ['name' => 'Minuman', 'slug' => 'minuman', 'description' => 'Minuman segar khas Nusantara.'],
            ['name' => 'Paket Oleh-oleh', 'slug' => 'paket-oleh-oleh', 'description' => 'Pilihan paket oleh-oleh lengkap.'],
            ['name' => 'Best Seller', 'slug' => 'best-seller', 'description' => 'Produk paling laris dan favorit.'],
            ['name' => 'Promo', 'slug' => 'promo', 'description' => 'Penawaran spesial dan diskon menarik.'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::updateOrCreate(['slug' => $category['slug']], $category);
        }

        // Optional: Remove categories not in the list if they have no products
        \App\Models\Category::whereNotIn('slug', array_column($categories, 'slug'))->each(function ($category) {
            if ($category->products()->count() == 0) {
                $category->delete();
            }
        });
    }
}
