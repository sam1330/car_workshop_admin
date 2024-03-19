<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_customer_can_be_created()
    {
        // Crea un usuario para asociarlo con el cliente
        $user = User::create([
            'first_name' => "fake()->name",
            'last_name' => 'mejia',
        'email' => "fake()->unique()->safeEmail",
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        ]);

        $this->actingAs($user);

        // Datos del cliente
        $customerData = [
            'first_name' => "Leslie",
            'last_name' => "Fernandez",
            'email' => "leslie@gmail.com",
            'phone' => "8297995316",
            'address' => "colorado",
            'user_id' => $user->id,
        ];

        // Hacer la petición para crear el cliente
        $response = $this->post(route('customers.store'), $customerData); // Asegúrate de que la ruta y el código de estado esperado sean correctos

        $response->assertStatus(302);
        // Verificar que el cliente está en la base de datos
        $this->assertDatabaseHas('customers', [
            'email' => $customerData['email'],
            // Agrega más verificaciones según sea necesario
        ]);
    }
}