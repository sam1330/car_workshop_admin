<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest(): void
    {
        $response = $this->get('/api/v1/reservations');

        $response->assertStatus(200);
        $this->assertDatabaseHas('reservations', [
            "type" => "servicio_al_cliente",
        ]);
    }
}
