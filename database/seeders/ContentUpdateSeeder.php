<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class ContentUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Truncate Tables to start fresh
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Create Categories
        $categories = [
            'Makanan' => 'Aneka makanan ringan dan berat khas lokal.',
            'Minuman' => 'Minuman segar dan tradisional.',
            'Kerajinan' => 'Produk kerajinan tangan unik dan kreatif.',
        ];

        $catIds = [];
        foreach ($categories as $name => $desc) {
            $cat = Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $desc,
                'image' => 'categories/' . Str::slug($name) . '.jpg', // Placeholder
            ]);
            $catIds[$name] = $cat->id;
        }

        // 3. Create Products
        $products = [
            [
                'name' => 'Binggel/Geblek "Mbak Ndet"',
                'category' => 'Makanan',
                'description' => 'Nikmati kelezatan Binggel dan Geblek khas "Mbak Ndet". Terbuat dari bahan pilihan dengan resep turun-temurun, menghadirkan cita rasa gurih dan tekstur yang kenyal. Cocok untuk cemilan santai bersama keluarga atau oleh-oleh khas daerah. Rasakan sensasi tradisional di setiap gigitan!',
                'price' => 15000,
                'stock' => 50,
                'whatsapp_number' => '6285801102795', // Real Number
                'image' => 'images/binggel.jpg', // Found in public/images
            ],
            [
                'name' => 'Opak Rahayu',
                'category' => 'Makanan',
                'description' => 'Opak Rahayu, kerupuk singkong renyah dengan bumbu spesial. Diproses secara higienis untuk menghasilkan opak yang tipis, garing, dan gurih. Teman setia untuk makan nasi atau sekadar camilan di waktu luang.',
                'price' => 12000,
                'stock' => 100,
                'whatsapp_number' => '6281298765432', // Dummy: beda
                'image' => 'products/opak.jpg', // Placeholder
            ],
            [
                'name' => '"JSC" Jahe Secang',
                'category' => 'Minuman',
                'description' => 'JSC (Jahe Secang) adalah minuman herbal instan yang menghangatkan tubuh. Perpaduan sempurna antara pedasnya jahe merah dan khasiat kayu secang. Praktis diseduh, nikmat diminum hangat maupun dingin. Jaga kesehatan tubuh dengan cara yang nikmat.',
                'price' => 25000,
                'stock' => 30,
                'whatsapp_number' => '6281357924680', // Dummy: beda
                'image' => 'products/jsc.jpg', // Placeholder
            ],
        ];

        foreach ($products as $seed) {
            Product::create([
                'category_id' => $catIds[$seed['category']],
                'name' => $seed['name'],
                'slug' => Str::slug($seed['name']),
                'description' => $seed['description'],
                'price' => $seed['price'],
                'stock' => $seed['stock'],
                'whatsapp_number' => $seed['whatsapp_number'],
                'image' => $seed['image'],
            ]);
        }
    }
}
