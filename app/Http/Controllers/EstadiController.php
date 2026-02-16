<?php

namespace App\Http\Controllers;

use App\Models\Estadi;
use App\Http\Requests\StoreEstadiRequest;
use App\Http\Requests\UpdateEstadiRequest;
use Illuminate\Http\Request;

use App\Services\LLMService;

class EstadiController extends Controller
{
    public function index()
    {
        $estadis = Estadi::all();
        return view('estadis.index', compact('estadis'));
    }

    public function show(Estadi $estadi)
    {
        $estadi->load('equips');

        $prompt = "Descriu l'estadi {$estadi->nom} de manera detallada, incloent la seva història i importància. La resposta ha de tenir unes 100 paraules.";

        $descripcio = LLMService::getResponse($prompt);

        return view('estadis.show', compact('estadi', 'descripcio'));
    }

    public function create()
    {
        return view('estadis.create');
    }

    public function store(StoreEstadiRequest $request)
    {
        $estadi = new Estadi($request->validated());
        $estadi->save();

        return redirect()
            ->route('estadis.index')
            ->with('success', 'Estadi afegit correctament!');
    }

    public function edit(Estadi $estadi)
    {
        return view('estadis.edit', compact('estadi'));
    }

    public function update(UpdateEstadiRequest $request, Estadi $estadi)
    {
        $estadi->update($request->validated());

        return redirect()
            ->route('estadis.index')
            ->with('success', 'Estadi actualitzat correctament!');
    }

    public function destroy(Estadi $estadi)
    {
        $estadi->delete();

        return redirect()
            ->route('estadis.index')
            ->with('success', 'Estadi esborrat correctament!');
    }
}
