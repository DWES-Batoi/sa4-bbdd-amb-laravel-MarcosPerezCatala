<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Equip;
use App\Services\ClassificacioService;

class ClassificacioController extends Controller
{
    public function index(ClassificacioService $classificacioService)
    {
        $stats = $classificacioService->posicionsPerEquip();

        $equips = Equip::all()
            ->sortBy(fn($e) => $stats[$e->id]['posicio'] ?? 999)
            ->values();

        return view('classificacio.index', compact('equips', 'stats'));
    }
}
