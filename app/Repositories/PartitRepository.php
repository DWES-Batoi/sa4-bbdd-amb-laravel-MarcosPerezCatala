<?php

namespace App\Repositories;

use App\Models\Partit;

class PartitRepository implements BaseRepository
{
    public function getAll()
    {
        return Partit::with(['local', 'visitant'])
            ->orderBy('data_partit', 'desc')
            ->get();
    }

    public function find($id)
    {
        return Partit::with(['local', 'visitant'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Partit::create($data);
    }

    public function update($id, array $data)
    {
        $partit = Partit::findOrFail($id);
        $partit->update($data);
        return $partit;
    }

    public function delete($id)
    {
        return Partit::destroy($id);
    }
}
