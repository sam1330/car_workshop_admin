<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => "Leonel",
            'last_name' => "Fernandez",
            'email' => "leon@gmail.com",
            'phone' => "8297995316",
            'address' => "colorado",
            'role' => "employee",
        ];
    }
}
