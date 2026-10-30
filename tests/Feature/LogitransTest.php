<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogitransTest extends TestCase
{
    use RefreshDatabase;

    // Test 1: La página de bienvenida/inicio carga correctamente
    public function test_welcome_page_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // Test 2: La página de login carga correctamente
    public function test_login_page_is_accessible(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    // Test 3: La página de registro carga correctamente
    public function test_register_page_is_accessible(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    // Test 4: El módulo de envíos es accesible (modo guest-friendly)
    public function test_envios_is_accessible(): void
    {
        $response = $this->get('/envios');
        $response->assertStatus(200);
    }

    // Test 5: El módulo de rutas es accesible (modo guest-friendly)
    public function test_rutas_is_accessible(): void
    {
        $response = $this->get('/rutas');
        $response->assertStatus(200);
    }

    // Test 6: El módulo de seguimientos es accesible (modo guest-friendly)
    public function test_seguimientos_is_accessible(): void
    {
        $response = $this->get('/seguimientos');
        $response->assertStatus(200);
    }

    // Test 7: Un usuario autenticado puede ver el listado de envíos
    public function test_authenticated_user_can_view_envios(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/envios');
        $response->assertStatus(200);
    }

    // Test 8: Un usuario autenticado puede ver el listado de rutas
    public function test_authenticated_user_can_view_rutas(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/rutas');
        $response->assertStatus(200);
    }
}