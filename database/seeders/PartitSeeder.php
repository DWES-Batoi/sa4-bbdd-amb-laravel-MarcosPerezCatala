<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partit;
use App\Models\Equip;
use Carbon\Carbon;

class PartitSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Obtenemos todos los IDs de los equipos existentes (ej: [1, 2, 3, 4...])
        $equipIds = Equip::pluck('id');

        // Si no hay equipos, no podemos crear partidos
        if ($equipIds->count() < 2) {
            $this->command->info('¡No hay suficientes equipos para crear partidos!');
            return;
        }

        for ($i = 0; $i < 100; $i++) {
            $localId = $equipIds->random();

            $visitantId = $equipIds->reject(function ($id) use ($localId) {
                return $id === $localId;
            })->random();

            Partit::create([
                'local_id' => $localId,
                'visitant_id' => $visitantId,
                'data_partit' => Carbon::now()->subDays(rand(0, 60))->addHours(rand(10, 20)), // Fecha aleatoria últimos 2 meses
                'gols_local' => rand(0, 5),
                'gols_visitant' => rand(0, 4),
                'estadi_id' => Equip::find($localId)->estadi_id ?? 1,
            ]);
        }

        $this->command->info('¡Creados 100 partidos aleatorios correctamente!');
    }

}
