<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BaseRepository;
use App\Repositories\EquipRepository;
use App\Repositories\JugadoraRepository;
use App\Services\EquipService;
use App\Services\JugadoraService;
use App\Services\PartitService;
use App\Repositories\PartitRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Quan EquipService demane BaseRepository, dona-li EquipRepository
        $this->app->when(EquipService::class)
                  ->needs(BaseRepository::class)
                  ->give(EquipRepository::class);

        // Quan JugadoraService demane BaseRepository, dona-li JugadoraRepository
        $this->app->when(JugadoraService::class)
                  ->needs(BaseRepository::class)
                  ->give(JugadoraRepository::class);
                  
        $this->app->when(PartitService::class)
          ->needs(BaseRepository::class)
          ->give(PartitRepository::class);          
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}