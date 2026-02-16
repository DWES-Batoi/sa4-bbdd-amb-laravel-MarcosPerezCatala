<?php

namespace App\Http\Controllers;

use App\Models\Jugadora;
use App\Models\Equip;
use App\Services\JugadoraService;
use App\Http\Requests\StoreJugadoraRequest;
use App\Http\Requests\UpdateJugadoraRequest;
use Illuminate\Http\Request;

class JugadoraController extends Controller
{
    public function __construct(private JugadoraService $servei)
    {
    }

    public function index()
    {
        $jugadoras = $this->servei->llistar();
        return view('jugadoras.index', compact('jugadoras'));
    }

    public function create()
    {
        $equips = Equip::all();
        return view('jugadoras.create', compact('equips'));
    }

    public function store(StoreJugadoraRequest $request)
    {
        $this->servei->guardar($request->validated());
        return redirect()->route('jugadoras.index')->with('success', 'Jugadora fitxada!');
    }

    public function show(Jugadora $jugadora)
    {
        return view('jugadoras.show', compact('jugadora'));
    }

    public function edit(Jugadora $jugadora)
    {
        $equips = Equip::all();
        return view('jugadoras.edit', compact('jugadora', 'equips'));
    }

    public function update(UpdateJugadoraRequest $request, Jugadora $jugadora)
    {
        $this->servei->actualitzar($jugadora->id, $request->validated());
        return redirect()->route('jugadoras.index')->with('success', 'Jugadora actualitzada!');
    }

    public function destroy(Jugadora $jugadora)
    {
        $this->servei->eliminar($jugadora->id);
        return redirect()->route('jugadoras.index')->with('success', 'Jugadora eliminada');
    }
}
