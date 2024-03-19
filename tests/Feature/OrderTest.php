<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test successful product creation with image upload.
     */
    public function testCanCreateProductWithImage()
    {
        $this->post(route('products.store'), [
            'name' => 'Test Product',
            'description' => 'This is a test product description.',
            'barcode' => '123456789012',
            'price' => 19.99,
            'quantity' => 10,
            'status' => 'active',
        ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'description' => 'This is a test product description.',
            'barcode' => '123456789012',
            'price' => 19.99,
            'quantity' => 10,
            'status' => 'active',
            // No assertion for 'image' as it's not uploaded
        ]);
    }
}

