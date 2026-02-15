<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $snack = \App\Models\Category::where('slug', 'snack')->first();
        $minuman = \App\Models\Category::where('slug', 'minuman')->first();
        // $kerajinan = \App\Models\Category::where('slug', 'kerajinan')->first(); // Removed as per new category structure

        $products = [
            [
                'category_id' => $snack->id ?? 1, // Fallback or ensure seed runs after CategorySeeder
                'name' => 'Binggel/Geblek "Mbak Ndet"',
                'slug' => 'binggel-geblek-mbak-ndet',
                'description' => 'Camilan tradisional gurih khas Mbak Ndet.',
                'price' => 5000,
                'stock' => 50,
                'whatsapp_number' => '6285801102795',
            ],
            [
                'category_id' => $snack->id ?? 1,
                'name' => 'Opak Rahayu',
                'slug' => 'opak-rahayu',
                'description' => 'Opak singkong renyah dan gurih.',
                'price' => 5000,
                'stock' => 50,
                'whatsapp_number' => '628210774387',
            ],
            [
                'category_id' => $minuman->id ?? 2,
                'name' => '"JSC" Jahe Secang',
                'slug' => 'jsc-jahe-secang',
                'description' => 'Minuman herbal alami yang menghangatkan tubuh.',
                'price' => 12000,
                'stock' => 50,
                'whatsapp_number' => '6285866253228',
            ],
            [
                'category_id' => $snack->id ?? 1,
                'name' => 'Getuk Lindri Fitri',
                'slug' => 'getuk-lindri-fitri',
                'description' => 'Getuk lindri manis dengan taburan kelapa.',
                'price' => 6000,
                'stock' => 50,
                'whatsapp_number' => '6285878426116',
            ],
            // Removed Kerajinan product as category is no longer active
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
