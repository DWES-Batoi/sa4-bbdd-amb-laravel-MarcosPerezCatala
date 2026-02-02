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
            $this->command->info('No hi ha suficients equips per crear partits!');
            return;
        }

        // 2. Creamos 20 partidos aleatorios
        for ($i = 0; $i < 20; $i++) {
            
            // Elegimos un local al azar
            $localId = $equipIds->random();

            // Elegimos un visitante al azar, PERO excluimos al local (para que no sea A vs A)
            $visitantId = $equipIds->reject(function ($id) use ($localId) {
                return $id === $localId;
            })->random();

            // Creamos el partido
            Partit::create([
                'local_id'      => $localId,
                'visitant_id'   => $visitantId,
                'data_partit'   => Carbon::now()->subDays(rand(0, 60))->addHours(rand(10, 20)), // Fecha aleatoria últimos 2 meses
                'gols_local'    => rand(0, 5), // Goles entre 0 y 5
                'gols_visitant' => rand(0, 4),
            ]);
        }

        $this->command->info('Creants 20 partits aleatoris correctamente!');
    }
    
}