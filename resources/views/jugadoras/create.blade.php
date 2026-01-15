@extends('layouts.equip')
@section('title', "Fitxar Jugadora")

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-blue-800 mb-6">Fitxar Nova Jugadora</h1>

    <form action="{{ route('jugadoras.store') }}" method="POST">
        @csrf

        {{-- Nom --}}
        <div class="mb-4">
            <label for="nom" class="block text-gray-700 font-bold mb-2">Nom de la jugadora:</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required 
                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            @error('nom') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Dorsal --}}
        <div class="mb-4">
            <label for="dorsal" class="block text-gray-700 font-bold mb-2">Dorsal:</label>
            <input type="number" name="dorsal" id="dorsal" value="{{ old('dorsal') }}" required 
                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            @error('dorsal') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Posició --}}
        <div class="mb-4">
            <label for="posicio" class="block text-gray-700 font-bold mb-2">Posició:</label>
            <select name="posicio" id="posicio" required 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 ">
                <option value="" disabled selected>Selecciona posició</option>
                <option value="Portera">Portera</option>
                <option value="Defensa">Defensa</option>
                <option value="Migcampista">Migcampista</option>
                <option value="Davantera">Davantera</option>
            </select>
            @error('posicio') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Equip --}}
        <div class="mb-6">
            <label for="equip_id" class="block text-gray-700 font-bold mb-2">Equip:</label>
            <select name="equip_id" id="equip_id" required 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                <option value="" disabled selected>Selecciona equip</option>
                @foreach($equips as $equip)
                    <option value="{{ $equip->id }}">{{ $equip->nom }}</option>
                @endforeach
            </select>
            @error('equip_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Botones --}}
        <div class="flex justify-end gap-4">
            <a href="{{ route('jugadoras.index') }}" class="text-gray-600 hover:underline py-2">Cancel·lar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                Guardar Jugadora
            </button>
        </div>
    </form>
</div>
@endsection