<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JugadoraTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_jugadores(): void
    {
        // Crear datos de prueba
        $equip = Equip::factory()->create();
        Jugadora::factory()->create(['nom' => 'Alexia Putellas', 'equip_id' => $equip->id]);
        Jugadora::factory()->create(['nom' => 'Aitana Bonmatí', 'equip_id' => $equip->id]);

        // Visitar la página
        $response = $this->get(route('jugadoras.index'));

        // Verificar
        $response->assertStatus(200);
        $response->assertSee('Alexia Putellas');
        $response->assertSee('Aitana Bonmatí');
    }
}
