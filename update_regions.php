<?php
use App\Models\Category;
use Illuminate\Support\Str;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$regions = [
    'Sumatera',
    'Jawa',
    'Kalimantan',
    'Sulawesi',
    'Bali & Nusa Tenggara',
    'Papua & Maluku'
];

foreach ($regions as $region) {
    Category::firstOrCreate(
        ['name' => $region],
        ['slug' => Str::slug($region)]
    );
}

echo "Regions updated successfully!";
