<?php

namespace Tests\Unit;

use App\Models\Partit;
use App\Models\Equip;
use App\Repositories\PartitRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class PartitRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected PartitRepository $repo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repo = new PartitRepository();
    }

    public function test_getAll_retorna_partits_ordenats_per_data_descendent()
    {
        // Crear equipos
        $local = Equip::factory()->create();
        $visitant = Equip::factory()->create();

        // Crear partits con fechas distintas
        $partitAntic = Partit::factory()->create([
            'data_partit' => Carbon::now()->subDays(10),
            'local_id' => $local->id,
            'visitant_id' => $visitant->id
        ]);

        $partitNou = Partit::factory()->create([
            'data_partit' => Carbon::now(),
            'local_id' => $visitant->id,
            'visitant_id' => $local->id
        ]);

        $resultat = $this->repo->getAll();

        // Verificar cantidad
        $this->assertCount(2, $resultat);
        
        // Verificar orden (el nuevo primero)
        $this->assertEquals($partitNou->id, $resultat->first()->id);
        
        // Verificar que carga las relaciones (Eager Loading)
        $this->assertTrue($resultat->first()->relationLoaded('local'));
        $this->assertTrue($resultat->first()->relationLoaded('visitant'));
    }

    public function test_create_guarda_a_la_base_de_dades()
    {
        $local = Equip::factory()->create();
        $visitant = Equip::factory()->create();

        $dades = [
            'local_id' => $local->id,
            'visitant_id' => $visitant->id,
            'data_partit' => Carbon::now(),
            'gols_local' => 2,
            'gols_visitant' => 1
        ];

        $partit = $this->repo->create($dades);

        $this->assertDatabaseHas('partits', ['gols_local' => 2]);
        $this->assertInstanceOf(Partit::class, $partit);
    }

    public function test_update_modifica_resultat()
    {
        $partit = Partit::factory()->create(['gols_local' => 0]);

        $this->repo->update($partit->id, ['gols_local' => 5]);

        $this->assertDatabaseHas('partits', [
            'id' => $partit->id,
            'gols_local' => 5
        ]);
    }
}