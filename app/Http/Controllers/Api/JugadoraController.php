<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JugadoraRequest;
use App\Http\Resources\JugadoraResource;
use App\Models\Jugadora;
use Illuminate\Http\Request;

class JugadoraController extends Controller
{
    public function index()
    {
        return JugadoraResource::collection(
            Jugadora::query()->paginate(10)
        );
    }

    public function store(JugadoraRequest $request)
    {
        $jugadora = Jugadora::create($request->validated());

        return (new JugadoraResource($jugadora))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Jugadora $jugadora)
    {
        return new JugadoraResource($jugadora);
    }

    public function update(JugadoraRequest $request, Jugadora $jugadora)
    {
        $jugadora->update($request->validated());

        return new JugadoraResource($jugadora);
    }

    public function destroy(Jugadora $jugadora)
    {
        $jugadora->delete();
        return response()->noContent();
    }
}
