<?php

namespace Tests\Unit;

use App\Models\Equip;
use App\Services\EquipService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\TestCase;
use App\Repositories\BaseRepository; // O EquipRepository si lo tienes específico

class EquipServiceTest extends TestCase
{
    use WithFaker;

    // Limpieza de Mockery tras cada test
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_guardar_crea_equip_i_puja_escut_si_cal()
    {
        Storage::fake('public'); // Simula el disco duro

        // Simulamos el repositorio (no queremos que guarde en BD real)
        $repo = Mockery::mock(BaseRepository::class);

        $data = ['nom' => 'FC Barcelona', 'titols' => 30];
        $escut = UploadedFile::fake()->image('escut.png', 200, 200);

        // Esperamos que el repo reciba una llamada 'create' con un path de imagen
        $repo->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function ($payload) {
                return isset($payload['escut']) && str_starts_with($payload['escut'], 'escuts/');
            }))
            ->andReturnUsing(function ($payload) use ($data) {
                return new Equip(array_merge($data, ['escut' => $payload['escut']]));
            });

        $service = new EquipService($repo);
        $equip = $service->guardar($data, $escut);

        // Verificamos que el archivo existe en el disco simulado
        Storage::disk('public')->assertExists($equip->escut);
    }

    public function test_actualitzar_sustitueix_escut_i_esborra_l_antic()
    {
        Storage::fake('public');

        $repo = Mockery::mock(BaseRepository::class);
        $equip = new Equip(['id' => 1, 'nom' => 'Barça', 'escut' => 'escuts/vell.png']);

        // Creamos el archivo "viejo"
        Storage::disk('public')->put($equip->escut, 'dummy');

        $repo->shouldReceive('find')->once()->with(1)->andReturn($equip);
        $repo->shouldReceive('update')
            ->once()
            ->with(1, Mockery::on(fn($payload) => isset($payload['escut']) && str_starts_with($payload['escut'], 'escuts/')))
            ->andReturn($equip);

        $service = new EquipService($repo);
        $nouEscut = UploadedFile::fake()->image('nou.png');

        $service->actualitzar(1, ['nom' => 'Barça'], $nouEscut);

        // Verificamos que el viejo se borró
        Storage::disk('public')->assertMissing('escuts/vell.png');
    }

    public function test_eliminar_esborra_escut_si_existeix()
    {
        Storage::fake('public');

        $repo = Mockery::mock(BaseRepository::class);
        $equip = new Equip(['id' => 2, 'escut' => 'escuts/logo.png']);
        Storage::disk('public')->put($equip->escut, 'dummy');

        $repo->shouldReceive('find')->once()->with(2)->andReturn($equip);
        $repo->shouldReceive('delete')->once()->with(2);

        $service = new EquipService($repo);
        $service->eliminar(2);

        Storage::disk('public')->assertMissing('escuts/logo.png');
    }
}