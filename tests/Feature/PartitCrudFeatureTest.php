<?php

namespace Tests\Feature;

use App\Models\Partit;
use App\Models\Equip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class PartitCrudFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Autorizar todo para simplificar tests de CRUD
        Gate::before(function () { return true; });
    }

    public function test_usuari_pot_veure_llistat_partits()
    {
        $user = User::factory()->create();
        Partit::factory()->count(3)->create();

        $response = $this->actingAs($user)->get(route('partits.index'));

        $response->assertStatus(200);
        $response->assertViewHas('partits');
    }

    public function test_usuari_pot_crear_partit_valid()
    {
        $user = User::factory()->create();
        $local = Equip::factory()->create();
        $visitant = Equip::factory()->create();

        $dades = [
            'local_id' => $local->id,
            'visitant_id' => $visitant->id,
            'data_partit' => '2026-05-20 20:00:00',
            'gols_local' => 0,
            'gols_visitant' => 0,
        ];

        $response = $this->actingAs($user)
                         ->post(route('partits.store'), $dades);

        $response->assertRedirect(route('partits.index'));
        $this->assertDatabaseHas('partits', ['data_partit' => '2026-05-20 20:00:00']);
    }

    public function test_validacio_falla_si_equips_son_iguals()
    {
        $user = User::factory()->create();
        $equip = Equip::factory()->create();

        // Intentamos poner el mismo equipo como local y visitante
        $dades = [
            'local_id' => $equip->id,
            'visitant_id' => $equip->id, // ERROR: Mismo ID
            'data_partit' => '2026-05-20',
            'gols_local' => 0,
            'gols_visitant' => 0,
        ];

        $response = $this->actingAs($user)
                         ->post(route('partits.store'), $dades);

        $response->assertSessionHasErrors('visitant_id'); // Debe fallar por 'different:local_id'
        $this->assertDatabaseCount('partits', 0);
    }

    public function test_usuari_pot_actualitzar_resultat()
    {
        $user = User::factory()->create();
        $partit = Partit::factory()->create([
            'gols_local' => 0,
            'gols_visitant' => 0
        ]);

        // Importante: Enviamos todos los datos requeridos por tu Request validate
        $dades = [
            'local_id' => $partit->local_id,
            'visitant_id' => $partit->visitant_id,
            'data_partit' => $partit->data_partit,
            'gols_local' => 3,     // Cambio
            'gols_visitant' => 2,  // Cambio
        ];

        $response = $this->actingAs($user)
                         ->put(route('partits.update', $partit), $dades);

        $response->assertRedirect(route('partits.index'));
        $this->assertDatabaseHas('partits', [
            'id' => $partit->id,
            'gols_local' => 3,
            'gols_visitant' => 2
        ]);
    }

    public function test_usuari_pot_eliminar_partit()
    {
        $user = User::factory()->create();
        $partit = Partit::factory()->create();

        $response = $this->actingAs($user)
                         ->delete(route('partits.destroy', $partit));

        $response->assertRedirect(route('partits.index'));
        $this->assertDatabaseMissing('partits', ['id' => $partit->id]);
    }
}