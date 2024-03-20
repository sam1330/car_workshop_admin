<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testItCanCreateAProduct()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        // Datos del cliente
        $productData = [
            'name' => fake()->name,
            'description' => "Fernandez",
            'barcode' => "leslie@gmail.com",
            'price' => 100,
            'quantity' => 100,
            'status' => true
        ];

        // Hacer la petición para crear el cliente
        $response = $this->post(route('products.store'), $productData); // Asegúrate de que la ruta y el código de estado esperado sean correctos

        // $response->dd();
        $response->assertStatus(302);
        // Verificar que el cliente está en la base de datos
        $this->assertDatabaseHas('products', [
            'name' => $productData['name'],
            // Agrega más verificaciones según sea necesario
        ]);
    }
}