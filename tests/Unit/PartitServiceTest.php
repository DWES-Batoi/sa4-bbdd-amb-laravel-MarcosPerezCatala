<?php

namespace Tests\Unit;

use App\Models\Partit;
use App\Services\PartitService;
use App\Repositories\PartitRepository;
use Mockery;
use Tests\TestCase;

class PartitServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_llistar_crida_al_repositori()
    {
        $repo = Mockery::mock(PartitRepository::class);
        $repo->shouldReceive('getAll')->once()->andReturn(['partit1', 'partit2']);

        $service = new PartitService($repo);
        $resultat = $service->llistar();

        $this->assertEquals(['partit1', 'partit2'], $resultat);
    }

    public function test_guardar_pasa_les_dades_al_repositori()
    {
        $repo = Mockery::mock(PartitRepository::class);
        $dades = ['local_id' => 1, 'visitant_id' => 2, 'gols_local' => 0];

        $repo->shouldReceive('create')
            ->once()
            ->with($dades)
            ->andReturn(new Partit($dades));

        $service = new PartitService($repo);
        $result = $service->guardar($dades);

        $this->assertInstanceOf(Partit::class, $result);
    }

    public function test_actualitzar_crida_update_del_repositori()
    {
        $repo = Mockery::mock(PartitRepository::class);
        $dades = ['gols_local' => 3];
        $id = 1;
        
        $partitSimulat = new Partit();
        
        $repo->shouldReceive('update')
            ->once()
            ->with($id, $dades)
            ->andReturn($partitSimulat);

        $service = new PartitService($repo);
        $result = $service->actualitzar($id, $dades);

        $this->assertEquals($partitSimulat, $result);
    }

    public function test_eliminar_crida_delete_del_repositori()
    {
        $repo = Mockery::mock(PartitRepository::class);
        $id = 5;

        $repo->shouldReceive('delete')
            ->once()
            ->with($id)
            ->andReturn(1);

        $service = new PartitService($repo);
        $result = $service->eliminar($id);

        $this->assertEquals(1, $result);
    }
}