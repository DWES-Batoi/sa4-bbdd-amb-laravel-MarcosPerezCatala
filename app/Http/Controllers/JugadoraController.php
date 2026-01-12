<?php

namespace App\Http\Controllers;

use App\Models\Jugadora;
use App\Models\Equip;
use App\Services\JugadoraService;
use Illuminate\Http\Request;

class JugadoraController extends Controller
{
    public function __construct(private JugadoraService $servei) {}

    /**
     * Llistar jugadores
     */
    public function index()
    {
        $jugadoras = $this->servei->llistar();
        // Ojo: Asegúrate de que la vista se llama 'jugadoras.index'
        return view('jugadoras.index', compact('jugadoras'));
    }

    /**
     * Formulari per crear
     */
    public function create()
    {
        $equips = Equip::all();
        return view('jugadoras.create', compact('equips'));
    }

    /**
     * Guardar nova jugadora
     */
    public function store(Request $request)
    {
        $dades = $request->validate([
            'nom' => 'required|min:3',
            'dorsal' => 'required|integer',
            'posicio' => 'required',
            'equip_id' => 'required|exists:equips,id'
        ]);

        $this->servei->guardar($dades);

        return redirect()->route('jugadoras.index')->with('success', 'Jugadora fitxada!');
    }

    /**
     * Veure fitxa detallada
     */
    public function show(Jugadora $jugadora)
    {
        return view('jugadoras.show', compact('jugadora'));
    }

    /**
     * Formulari d'edició
     */
    public function edit(Jugadora $jugadora)
    {
        $equips = Equip::all();
        return view('jugadoras.edit', compact('jugadora', 'equips'));
    }

    /**
     * Actualitzar dades
     */
    public function update(Request $request, Jugadora $jugadora)
    {
        $dades = $request->validate([
            'nom' => 'required|min:3',
            'dorsal' => 'required|integer',
            'posicio' => 'required',
            'equip_id' => 'required|exists:equips,id'
        ]);

        $this->servei->actualitzar($jugadora->id, $dades);

        return redirect()->route('jugadoras.index')->with('success', 'Jugadora actualitzada!');
    }

    /**
     * Eliminar jugadora
     */
    public function destroy(Jugadora $jugadora)
    {
        $this->servei->eliminar($jugadora->id);
        return redirect()->route('jugadoras.index')->with('success', 'Jugadora eliminada');
    }
}