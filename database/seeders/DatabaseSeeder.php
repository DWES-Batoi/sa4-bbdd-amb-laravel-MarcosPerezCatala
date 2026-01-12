<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EstadisSeeder::class,
            EquipsSeeder::class,
            JugadoraSeeder::class,
            PartitSeeder::class,
        ]);

        dump('DatabaseSeeder: TOTES LES DADES CARREGADES');
    }
}