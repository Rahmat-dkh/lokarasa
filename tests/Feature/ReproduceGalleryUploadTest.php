<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ReproduceGalleryUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_upload_multiple_gallery_images()
    {
        Storage::fake('public');

        // Create Admin User
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        // Create Category
        $category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
            'icon' => 'test-icon.png'
        ]);

        // Prepare Data
        $data = [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 100000,
            'stock' => 10,
            'category_id' => $category->id,
            'whatsapp_number' => '628123456789',
            'gallery_images' => [
                UploadedFile::fake()->image('photo1.jpg'),
                UploadedFile::fake()->image('photo2.jpg'),
            ]
        ];

        // Act
        $response = $this->actingAs($admin)
            ->post(route('admin.products.store'), $data);

        // Assert
        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
        $this->assertDatabaseCount('product_images', 2);
    }
}
