<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            EstadisSeeder::class,
            EquipsSeeder::class,
            JugadoraSeeder::class,
            PartitSeeder::class,
            UserSeeder::class,
        ]);

        dump('DatabaseSeeder: TODOS LOS DATOS CARGADOS');
    }
}
