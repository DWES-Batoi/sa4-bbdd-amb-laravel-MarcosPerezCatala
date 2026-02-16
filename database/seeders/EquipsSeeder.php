<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Estadi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EquipsSeeder extends Seeder
{
    public function run(): void
    {
        $equips = [
            'Barça Femení',
            'Real Madrid Femení',
            'Atlètic de Madrid',
            'Levante UD',
            'Madrid CFF',
            'Sevilla FC',
            'Real Sociedad',
            'UDG Tenerife',
            'Athletic Club',
            'Valencia CF',
            'Levante Las Planas',
            'Real Betis',
            'Villarreal CF',
            'SD Eibar',
            'Granada CF',
            'Deportivo Abanca'
        ];

        $estadis = Estadi::all();

        foreach ($equips as $nomEquip) {
            $estadi = $estadis->random();

            $estadi->equips()->updateOrCreate(
                ['nom' => $nomEquip],
                ['titols' => rand(0, 30)]
            );
        }


        $todosLosEquipos = Equip::all();

        foreach ($todosLosEquipos as $equip) {
            User::updateOrCreate(
                ['email' => $equip->id . '@manager.com'],
                [
                    'name' => 'Manager ' . $equip->nom,
                    'password' => Hash::make('1234'),
                    'role' => 'manager',
                    'equip_id' => $equip->id,
                ]
            );
        }
    }
}
