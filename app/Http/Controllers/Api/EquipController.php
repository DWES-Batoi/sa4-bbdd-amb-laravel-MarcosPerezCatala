<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Equip;
use App\Http\Resources\EquipResource;
use App\Http\Requests\StoreEquipRequest;
use App\Http\Requests\UpdateEquipRequest;
use Illuminate\Http\Request;

class EquipController extends Controller
{
    public function index()
    {
        return EquipResource::collection(Equip::with('estadi')->paginate(10));
    }

    public function store(StoreEquipRequest $request)
    {
        $equip = Equip::create($request->validated());
        return new EquipResource($equip);
    }

    public function show(Equip $equip)
    {
        return new EquipResource($equip->load('estadi'));
    }

    public function update(UpdateEquipRequest $request, Equip $equip)
    {
        $equip->update($request->validated());
        return new EquipResource($equip);
    }

    public function destroy(Equip $equip)
    {
        $equip->delete();
        return response()->json(null, 204);
    }
}
