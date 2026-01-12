<?php

namespace App\Repositories;

use App\Models\Partit;

class PartitRepository implements BaseRepository
{
    // Obtener todos los partidos con sus equipos
    public function getAll()
    {
        return Partit::with(['local', 'visitant'])
                     ->orderBy('data_partit', 'desc')
                     ->get();
    }

    // Buscar uno por ID
    public function find($id)
    {
        return Partit::with(['local', 'visitant'])->findOrFail($id);
    }

    // Crear
    public function create(array $data)
    {
        return Partit::create($data);
    }

    // Actualizar
    public function update($id, array $data)
    {
        $partit = Partit::findOrFail($id);
        $partit->update($data);
        return $partit;
    }

    // Borrar (Devuelve true/false o el número de filas borradas)
    public function delete($id)
    {
        return Partit::destroy($id);
    }
}