<?php

namespace Database\Seeders;

use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Database\Seeder;

class JugadoraSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Cogemos todos los IDs de los equipos que ya hemos creado en EquipsSeeder
        $equipsIds = Equip::pluck('id');

        // 2. Creamos, por ejemplo, 40 jugadoras
        // Usamos la factory, pero forzamos que el equip_id sea uno de los que ya existen
        for ($i = 0; $i < 40; $i++) {
            Jugadora::factory()->create([
                'equip_id' => $equipsIds->random(),
            ]);
        }

        dump("JugadoraSeeder: Se han creado 40 jugadoras repartidas en los equipos actuales.");
    }

}
