@extends('layouts.equip')
@section('title', "Editar Resultat")

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-blue-800 mb-6">Resultat: {{ $partit->local->nom }} vs {{ $partit->visitant->nom }}</h1>

    <form action="{{ route('partits.update', $partit) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Gols Local --}}
        <div class="mb-4">
            <label for="gols_local" class="block text-gray-700 font-bold mb-2">Gols Local ({{ $partit->local->nom }}):</label>
            <input type="number" name="gols_local" id="gols_local" value="{{ old('gols_local', $partit->gols_local) }}" min="0" required 
                   class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        {{-- Gols Visitant --}}
        <div class="mb-6">
            <label for="gols_visitant" class="block text-gray-700 font-bold mb-2">Gols Visitant ({{ $partit->visitant->nom }}):</label>
            <input type="number" name="gols_visitant" id="gols_visitant" value="{{ old('gols_visitant', $partit->gols_visitant) }}" min="0" required 
                   class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('partits.index') }}" class="text-gray-600 hover:underline py-2">Cancel·lar</a>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow">
                Actualitzar Marcador
            </button>
        </div>
    </form>
</div>
@endsection