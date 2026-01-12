<?php

namespace App\Services;

use App\Repositories\BaseRepository;

class PartitService
{
    public function __construct(private BaseRepository $repository)
    {
    }

    public function llistar()
    {
        return $this->repository->getAll();
    }

    public function guardar(array $dades)
    {
        return $this->repository->create($dades);
    }

    public function actualitzar($id, array $dades)
    {
        return $this->repository->update($id, $dades);
    }

    public function eliminar($id)
    {
        return $this->repository->delete($id);
    }

    public function trobar($id)
    {
        return $this->repository->find($id);
    }
}