@extends('layouts.equip')
@section('title', "Editar Jugadora")

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-blue-800 mb-6">Editar: {{ $jugadora->nom }}</h1>

    <form action="{{ route('jugadoras.update', $jugadora) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nom --}}
        <div class="mb-4">
            <label for="nom" class="block text-gray-700 font-bold mb-2">Nom:</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $jugadora->nom) }}" required 
                   class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        {{-- Dorsal --}}
        <div class="mb-4">
            <label for="dorsal" class="block text-gray-700 font-bold mb-2">Dorsal:</label>
            <input type="number" name="dorsal" id="dorsal" value="{{ old('dorsal', $jugadora->dorsal) }}" required 
                   class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        {{-- Posició --}}
        <div class="mb-4">
            <label for="posicio" class="block text-gray-700 font-bold mb-2">Posició:</label>
            <select name="posicio" id="posicio" required class="w-full border-gray-300 rounded-md shadow-sm">
                @foreach(['Portera', 'Defensa', 'Migcampista', 'Davantera'] as $pos)
                    <option value="{{ $pos }}" {{ $jugadora->posicio == $pos ? 'selected' : '' }}>
                        {{ $pos }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Equip --}}
        <div class="mb-6">
            <label for="equip_id" class="block text-gray-700 font-bold mb-2">Equip:</label>
            <select name="equip_id" id="equip_id" required class="w-full border-gray-300 rounded-md shadow-sm">
                @foreach($equips as $equip)
                    <option value="{{ $equip->id }}" {{ $jugadora->equip_id == $equip->id ? 'selected' : '' }}>
                        {{ $equip->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Botones --}}
        <div class="flex justify-end gap-4">
            <a href="{{ route('jugadoras.index') }}" class="text-gray-600 hover:underline py-2">Cancel·lar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                Actualitzar
            </button>
        </div>
    </form>
</div>
@endsection