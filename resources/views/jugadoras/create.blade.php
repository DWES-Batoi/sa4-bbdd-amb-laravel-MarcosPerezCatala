@extends('layouts.app')
@section('title', 'Fitxar nova jugadora')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-blue-800 border-b pb-4">Nova Jugadora</h1>

    @if ($errors->any())
      <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
        <p class="font-bold">Corregeix els següents errors:</p>
        <ul class="list-disc ml-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('jugadoras.store') }}" method="POST" class="space-y-6">
      @csrf

      <div>
        <label for="nom" class="block text-sm font-medium text-gray-700">Nom Complet:</label>
        <input type="text" name="nom" id="nom" value="{{ old('nom') }}" 
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border" 
               placeholder="Ex: Alexia Putellas">
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="dorsal" class="block text-sm font-medium text-gray-700">Dorsal:</label>
          <input type="number" name="dorsal" id="dorsal" value="{{ old('dorsal') }}" 
                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border" 
                 placeholder="1-99">
        </div>

        <div>
          <label for="posicio" class="block text-sm font-medium text-gray-700">Posició:</label>
          <select name="posicio" id="posicio" 
                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border">
            <option value="">Selecciona posició...</option>
            <option value="Portera" {{ old('posicio') == 'Portera' ? 'selected' : '' }}>Portera</option>
            <option value="Defensa" {{ old('posicio') == 'Defensa' ? 'selected' : '' }}>Defensa</option>
            <option value="Migcampista" {{ old('posicio') == 'Migcampista' ? 'selected' : '' }}>Migcampista</option>
            <option value="Davantera" {{ old('posicio') == 'Davantera' ? 'selected' : '' }}>Davantera</option>
          </select>
        </div>
      </div>

      <div>
        <label for="equip_id" class="block text-sm font-medium text-gray-700">Equip:</label>
        <select name="equip_id" id="equip_id" 
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border">
          <option value="">Selecciona l'equip...</option>
          @foreach ($equips as $equip)
            <option value="{{ $equip->id }}" {{ old('equip_id') == $equip->id ? 'selected' : '' }}>
              {{ $equip->nom }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="flex items-center justify-end space-x-4 border-t pt-6">
        <a href="{{ route('jugadoras.index') }}" class="text-gray-600 hover:text-gray-900">Cancel·lar</a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow transition duration-150">
          Guardar Fitxatge
        </button>
      </div>
    </form>
</div>
@endsection