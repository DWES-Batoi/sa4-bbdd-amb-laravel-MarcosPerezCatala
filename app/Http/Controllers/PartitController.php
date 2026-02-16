<?php

namespace App\Http\Controllers;

use App\Models\Partit;
use App\Models\Equip;
use App\Events\PartitActualitzat;
use App\Services\ClassificacioService;
use App\Services\PartitService;
use App\Http\Requests\StorePartitRequest;
use App\Http\Requests\UpdatePartitRequest;
use Illuminate\Http\Request;

class PartitController extends Controller
{
    public function __construct(
        private PartitService $servei,
        private ClassificacioService $classificacioService
    ) {
    }

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

    public function store(StorePartitRequest $request)
    {
        $this->servei->guardar($request->validated());

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

    public function update(UpdatePartitRequest $request, Partit $partit)
    {
        $abans = $this->classificacioService->posicionsPerEquip();
        $this->servei->actualitzar($partit->id, $request->validated());
        $despres = $this->classificacioService->posicionsPerEquip();

        // Calcula canvis de posició
        $delta = [];
        foreach ($despres as $equipId => $statDespres) {
            $posDespres = $statDespres['posicio'];
            $posAbans = $abans[$equipId]['posicio'] ?? $posDespres;
            $deltaPos = $posAbans - $posDespres;
            if ($deltaPos !== 0) {
                $delta[] = ['equip_id' => $equipId, 'delta' => $deltaPos];
            }
        }

        if (!empty($delta)) {
            event(new PartitActualitzat($delta));
        }

        return redirect()->route('partits.index')->with('success', 'Resultat actualitzat!');
    }

    public function destroy(Partit $partit)
    {
        $this->servei->eliminar($partit->id);

        return redirect()->route('partits.index')->with('success', 'Partit eliminat del calendari.');
    }
}
