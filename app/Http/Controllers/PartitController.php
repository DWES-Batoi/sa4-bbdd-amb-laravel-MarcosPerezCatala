<?php

namespace App\Http\Controllers;

use App\Models\Partit;
use App\Models\Equip;
use App\Services\PartitService;
use Illuminate\Http\Request;

class PartitController extends Controller
{
    public function __construct(private PartitService $servei) {}

    public function index()
    {
        $partits = $this->servei->llistar();
        return view('partits.index', compact('partits'));
    }

    public function create()
    {
        $equips = Equip::all();
        return view('partits.create', compact('equips'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'local_id'      => 'required|exists:equips,id',
            'visitant_id'   => 'required|exists:equips,id|different:local_id',
            'data_partit'   => 'required|date',
            'gols_local'    => 'integer|min:0',
            'gols_visitant' => 'integer|min:0',
        ]);

        $this->servei->guardar($validated);

        return redirect()->route('partits.index')->with('success', 'Partit creat correctament!');
    }

    public function show(Partit $partit)
    {
        return view('partits.show', compact('partit'));
    }

    public function edit(Partit $partit)
    {
        $equips = Equip::all();
        return view('partits.edit', compact('partit', 'equips'));
    }

    public function update(Request $request, Partit $partit)
    {
        $validated = $request->validate([
            'local_id'      => 'required|exists:equips,id',
            'visitant_id'   => 'required|exists:equips,id|different:local_id',
            'data_partit'   => 'required|date',
            'gols_local'    => 'required|integer|min:0',
            'gols_visitant' => 'required|integer|min:0',
        ]);

        $this->servei->actualitzar($partit->id, $validated);

        return redirect()->route('partits.index')->with('success', 'Resultat actualitzat!');
    }

    public function destroy(Partit $partit)
    {
        $this->servei->eliminar($partit->id);
        
        return redirect()->route('partits.index')->with('success', 'Partit eliminat del calendari.');
    }
}