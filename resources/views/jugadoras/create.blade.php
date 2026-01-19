
@extends('layouts.equip')
@section('title', __('Fitxar Jugadora'))

@section('content')
{{-- Forzamos color negro con style para asegurar que se vea --}}
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md" style="color: black !important;">
    <h1 class="text-2xl font-bold text-black mb-6">{{ __('Fitxar Jugadora') }}</h1>

    <form action="{{ route('jugadoras.store') }}" method="POST">
        @csrf

        {{-- Nom --}}
        <div class="mb-4">
            <label for="nom" class="block text-black font-bold mb-2">{{ __('Nom') }}:</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required 
                   class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black">
            @error('nom') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Dorsal --}}
        <div class="mb-4">
            <label for="dorsal" class="block text-black font-bold mb-2">{{ __('Dorsal') }}:</label>
            <input type="number" name="dorsal" id="dorsal" value="{{ old('dorsal') }}" required 
                   class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black">
            @error('dorsal') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Posició --}}
        <div class="mb-4">
            <label for="posicio" class="block text-black font-bold mb-2">{{ __('Posició') }}:</label>
            <select name="posicio" id="posicio" required 
                    class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black appearance-none">
                <option value="" disabled selected class="text-gray-500">{{ __('Selecciona posició') }}</option>
                <option value="Portera" class="text-black">{{ __('Portera') }}</option>
                <option value="Defensa" class="text-black">{{ __('Defensa') }}</option>
                <option value="Migcampista" class="text-black">{{ __('Migcampista') }}</option>
                <option value="Davantera" class="text-black">{{ __('Davantera') }}</option>
            </select>
            @error('posicio') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Equip --}}
        <div class="mb-6">
            <label for="equip_id" class="block text-black font-bold mb-2">{{ __('Equip') }}:</label>
            <select name="equip_id" id="equip_id" required 
                    class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black appearance-none">
                <option value="" disabled selected class="text-gray-500">{{ __('Selecciona equip') }}</option>
                @foreach($equips as $equip)
                    <option value="{{ $equip->id }}" class="text-black">{{ $equip->nom }}</option>
                @endforeach
            </select>
            @error('equip_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('jugadoras.index') }}" class="text-black hover:underline py-2">{{ __('Cancel·lar') }}</a>
            <button type="submit" class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded shadow">
                {{ __('Guardar Jugadora') }}
            </button>
        </div>
    </form>
</div>
@endsection