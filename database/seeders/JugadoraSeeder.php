<?php

namespace Database\Seeders;

use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Database\Seeder;

class JugadoraSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Agafem tots els IDs dels equips que ja hem creat en EquipsSeeder
        $equipsIds = Equip::pluck('id');

        // 2. Creem, per exemple, 40 jugadoras
        // Usem la factory, però forcem que l'equip_id siga un dels que ja existeixen
        for ($i = 0; $i < 40; $i++) {
            Jugadora::factory()->create([
                'equip_id' => $equipsIds->random(),
            ]);
        }

        dump("JugadoraSeeder: S'han creat 40 jugadoras repartides en els equips actuals.");
    }

}
