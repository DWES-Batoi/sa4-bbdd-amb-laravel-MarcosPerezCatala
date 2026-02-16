<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EquipTest extends TestCase
{
    use RefreshDatabase; // Reinicia la BBDD para cada test

    public function test_guest_cannot_see_create_button(): void
    {
        $response = $this->get(route('equips.index'));

        $response->assertStatus(200);
        $response->assertDontSee('Nou Equip');
    }

    public function test_admin_can_create_equip_with_image(): void
    {
        Storage::fake('public'); // Simula el disco public

        $admin = User::factory()->create(['role' => 'administrador']);
        $estadi = Estadi::factory()->create();

        $file = UploadedFile::fake()->image('escudo.jpg');

        $response = $this->actingAs($admin)
            ->post(route('equips.store'), [
                'nom' => 'Nuevo Equipo Test',
                'titols' => 5,
                'estadi_id' => $estadi->id,
                'escut' => $file,
            ]);

        // Debe redirigir al index
        $response->assertRedirect(route('equips.index'));

        // Verificar que se ha guardado en DB
        $this->assertDatabaseHas('equips', [
            'nom' => 'Nuevo Equipo Test',
        ]);

        // Verificar que el archivo existe (Laravel guarda el hash como nombre)
        // Buscamos el equipo para saber el nombre del archivo guardado
        $equip = Equip::where('nom', 'Nuevo Equipo Test')->first();
        Storage::disk('public')->assertExists($equip->escut);
    }
}
