@extends('layouts.equip')
@section('title', 'Editar equip')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Editar equip: {{ $equip->nom }}</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ¡IMPORTANTE! enctype para subir archivos --}}
    <form action="{{ route('equips.update', $equip) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div>
            <label for="nom" class="block font-bold">Nom:</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $equip->nom) }}" class="border p-2 w-full rounded">
        </div>

        {{-- Estadio --}}
        <div>
            <label for="estadi_id" class="block font-bold">Estadi:</label>
            <select name="estadi_id" id="estadi_id" class="border p-2 w-full rounded">
                @foreach ($estadis as $estadi)
                    <option value="{{ $estadi->id }}" {{ old('estadi_id', $equip->estadi_id) == $estadi->id ? 'selected' : '' }}>
                        {{ $estadi->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Títulos --}}
        <div>
            <label for="titols" class="block font-bold">Títols:</label>
            <input type="number" name="titols" id="titols" value="{{ old('titols', $equip->titols) }}"
                class="border p-2 w-full rounded">
        </div>

        {{-- SECCIÓN ESCUDO --}}
        <div class="border p-4 rounded bg-gray-50">
            <label class="block font-bold mb-2">Escut:</label>

            {{-- 1. Si ya tiene escudo, lo mostramos --}}
            @if($equip->escut)
                <div class="mb-3 flex items-center gap-4">
                    <img src="{{ asset('storage/' . $equip->escut) }}" alt="Escut actual"
                        class="h-16 w-16 object-cover rounded-full border border-gray-300">
                    <span class="text-sm text-gray-600">Escut actual</span>
                </div>
            @endif

            {{-- 2. Input para subir uno nuevo --}}
            <label class="block text-sm text-gray-600 mb-1">Pujar nou escut (opcional):</label>
            <input type="file" name="escut" id="escut" class="border p-2 w-full rounded bg-white">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                Guardar Canvis
            </button>

            <a href="{{ route('equips.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">
                Cancel·lar
            </a>
        </div>
    </form>
@endsection