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

    public function testStoreMethod()
    {
        // Arrange
        Storage::fake('public');

        $data = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'role' => $this->faker->word,
            'hability' => 1, // Replace with the appropriate value for hability
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
        ];

        // Act
        $response = $this->post(route('employees.store'), $data);

        // Assert
        $response->assertRedirect(route('employees.index'))
            ->assertSessionHas('success');

        $employee = Employee::latest()->first();

        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'role' => $data['role'],
            'hability_id' => $data['hability'],
            'avatar' => 'employees/' . $employee->id . '/avatar.jpg', // Check if the avatar path is correct
        ]);

        Storage::disk('public')->assertExists('employees/' . $employee->id . '/avatar.jpg');
    }
}

