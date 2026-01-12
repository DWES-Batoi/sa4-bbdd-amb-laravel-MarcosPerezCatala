<?php

namespace App\Repositories;

use App\Models\Jugadora;

class JugadoraRepository implements BaseRepository {
    
    public function getAll() {
        // Fem un "with" per carregar l'equip i evitar el problema de N+1 consultes
        return Jugadora::with('equip')->get();
    }

    public function find($id) {
        return Jugadora::findOrFail($id);
    }

    public function create(array $data) {
        return Jugadora::create($data);
    }

    public function update($id, array $data) {
        $jugadora = Jugadora::findOrFail($id);
        $jugadora->update($data);
        return $jugadora;
    }

    public function delete($id) {
        return Jugadora::destroy($id);
    }
}