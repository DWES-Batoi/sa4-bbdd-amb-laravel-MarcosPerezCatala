<?php

namespace App\Repositories;

use App\Models\Partit;

class PartitRepository implements BaseRepository
{
    /**
     * Obtenir tots els partits amb els equips carregats
     */
    public function getAll()
    {
        // 'local' y 'visitant' son los nombres de las funciones en el Modelo Partit
        return Partit::with(['local', 'visitant'])
                     ->orderBy('data_partit', 'desc')
                     ->get();
    }

    /**
     * Trobar un partit per ID
     */
    public function find($id)
    {
        return Partit::with(['local', 'visitant'])->findOrFail($id);
    }

    /**
     * Crear un nou partit
     */
    public function create(array $data)
    {
        return Partit::create($data);
    }

    /**
     * Actualitzar un partit
     */
    public function update($id, array $data)
    {
        $partit = Partit::findOrFail($id);
        $partit->update($data);
        return $partit;
    }

    /**
     * Eliminar un partit
     */
    public function delete($id)
    {
        return Partit::destroy($id);
    }
}