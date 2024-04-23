<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testItCanCreateEmployee()
    {
        // Crea un usuario para asociarlo con el cliente
        $user = User::factory()->create();

        $this->actingAs($user);

        // Datos del cliente
        $employeeData = [
            'first_name' => "Leslie",
            'last_name' => "Fernandez",
            'email' => "leslie@gmail.com",
            'phone' => "8297995316",
            'address' => "colorado",
            'role' => "employee",
        ];

        // Hacer la petición para crear el cliente
        $response = $this->post(route('employees.store'), $employeeData); // Asegúrate de que la ruta y el código de estado esperado sean correctos

        $response->assertStatus(302);
        // Verificar que el cliente está en la base de datos
        $this->assertDatabaseHas('employees', [
            'email' => $employeeData['email'],
            'phone' => $employeeData['phone'],
            'address' => $employeeData['address'],
            'role' => $employeeData['role'],
            // Agrega más verificaciones según sea necesario
        ]);
    }

    /** @test */
    public function testItCannotCreateEmployeeWithoutFirstName()
    {
        // Crea un usuario para asociarlo con el empleado
        $user = User::factory()->create();

        $this->actingAs($user);

        // Datos del empleado
        $employeeData = [
            'last_name' => "Fernandez",
            'email' => "fernando@gmail.com",
            'phone' => "8297995316",
            'address' => "colorado",
            'role' => "employee",
        ];

        // Hacer la petición para crear el empleado
        $response = $this->post(route('employees.store'), $employeeData); // Asegúrate de que la ruta y el código de estado esperado sean correctos

        $response->assertStatus(302);

        // Verificar que el empleado no está en la base de datos
        $this->assertDatabaseMissing('employees', [
            'email' => $employeeData['email'],
        ]);
    }

    public function testItCannotCreateEmployeeWithoutLastName()
    {
        // Crea un usuario para asociarlo con el empleado
        $user = User::factory()->create();

        $this->actingAs($user);

        // Datos del empleado
        $employeeData = [
            'first_name' => "Fernandez",
            'email' => "fernando@gmail.com",
            'phone' => "8297995316",
            'address' => "colorado",
            'role' => "employee",
        ];

        // Hacer la petición para crear el empleado
        $response = $this->post(route('employees.store'), $employeeData); // Asegúrate de que la ruta y el código de estado esperado sean correctos

        $response->assertStatus(302);

        // Verificar que el empleado no está en la base de datos
        $this->assertDatabaseMissing('employees', [
            'email' => $employeeData['email'],
        ]);
    }


     /** @test */
     public function testItCanUpdateEmployee()
     {
         // Crea un usuario para asociarlo con el empleado
         $user = User::factory()->create();
         $employee = Employee::factory()->create();
 
         $this->actingAs($user);
 
         // Datos del empleado
         $employeeData = [
             'last_name' => "Fernandez",
             'email' => "fernando@gmail.com",
             'phone' => "8297995316",
             'address' => "colorado",
             'role' => "employee",
         ];
 
         // Hacer la petición para crear el empleado
         $response = $this->put(route('employees.update', [
            'employee' => $employee->id
        ]), $employeeData); // Asegúrate de que la ruta y el código de estado esperado sean correctos
 
         $response->assertStatus(302);
 
         // Verificar que el empleado no está en la base de datos
         $this->assertDatabaseHas('employees', [
             'email' => $employeeData['email'],
         ]);
     }
}