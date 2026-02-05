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
            ['name' => 'Makanan', 'slug' => 'makanan', 'description' => 'Aneka makanan lezat dan cemilan.'],
            ['name' => 'Minuman', 'slug' => 'minuman', 'description' => 'Minuman segar dan menyehatkan.'],
            ['name' => 'Kerajinan', 'slug' => 'kerajinan', 'description' => 'Produk kerajinan tangan unik dan kreatif.'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
