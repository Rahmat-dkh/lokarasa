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
        $makanan = \App\Models\Category::where('slug', 'makanan')->first();
        $minuman = \App\Models\Category::where('slug', 'minuman')->first();
        $kerajinan = \App\Models\Category::where('slug', 'kerajinan')->first();

        $products = [
            [
                'category_id' => $makanan->id,
                'name' => 'Binggel/Geblek "Mbak Ndet"',
                'slug' => 'binggel-geblek-mbak-ndet',
                'description' => 'Camilan tradisional gurih khas Mbak Ndet.',
                'price' => 5000,
                'stock' => 50,
                'whatsapp_number' => '6285801102795',
            ],
            [
                'category_id' => $makanan->id,
                'name' => 'Opak Rahayu',
                'slug' => 'opak-rahayu',
                'description' => 'Opak singkong renyah dan gurih.',
                'price' => 5000,
                'stock' => 50,
                'whatsapp_number' => '628210774387',
            ],
            [
                'category_id' => $minuman->id,
                'name' => '"JSC" Jahe Secang',
                'slug' => 'jsc-jahe-secang',
                'description' => 'Minuman herbal alami yang menghangatkan tubuh.',
                'price' => 12000,
                'stock' => 50,
                'whatsapp_number' => '6285866253228',
            ],
            [
                'category_id' => $makanan->id,
                'name' => 'Getuk Lindri Fitri',
                'slug' => 'getuk-lindri-fitri',
                'description' => 'Getuk lindri manis dengan taburan kelapa.',
                'price' => 6000,
                'stock' => 50,
                'whatsapp_number' => '6285878426116',
            ],
            [
                'category_id' => $kerajinan->id,
                'name' => 'Zanfi Craft (Kerajinan Kulit Telur)',
                'slug' => 'zanfi-craft-kerajinan-kulit-telur',
                'description' => 'Kerajinan unik dari kulit telur.',
                'price' => 50000,
                'stock' => 10,
                'whatsapp_number' => '6289626824392',
            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
