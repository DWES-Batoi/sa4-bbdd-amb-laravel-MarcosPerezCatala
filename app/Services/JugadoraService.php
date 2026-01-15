<?php

namespace App\Services;

use App\Repositories\BaseRepository;

class JugadoraService
{
    /**
     * Inyectamos el repositorio usando la interfaz BaseRepository.
     * Gracias al ServiceProvider, Laravel le pasará el JugadoraRepository.
     */
    public function __construct(private BaseRepository $repo) {}

    public function llistar()
    {
        return $this->repo->getAll();
    }

    public function trobar($id)
    {
        return $this->repo->find($id);
    }

    public function guardar(array $data)
    {
        // Aquí podrías añadir lógica extra (ej: no permitir dorsales duplicados en el mismo equipo)
        return $this->repo->create($data);
    }

    public function actualitzar($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function eliminar($id)
    {
        return $this->repo->delete($id);
    }
}