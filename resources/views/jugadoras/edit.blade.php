@extends('layouts.app')

@section('title', 'Editar Jugadora')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-blue-800 border-b pb-4">Editar Jugadora: {{ $jugadora->nom }}</h1>

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

    <form action="{{ route('jugadoras.update', $jugadora->id) }}" method="POST" class="space-y-6">
      @csrf
      @method('PUT') {{-- ¡VITAL! Esto convierte el POST en un PUT para Laravel --}}

      <div>
        <label for="nom" class="block text-sm font-medium text-gray-700">Nom Complet:</label>
        {{-- old('nom', $jugadora->nom) -> Si hay error, usa lo viejo. Si no, usa el dato de la BDD --}}
        <input type="text" name="nom" id="nom" value="{{ old('nom', $jugadora->nom) }}" 
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border">
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="dorsal" class="block text-sm font-medium text-gray-700">Dorsal:</label>
          <input type="number" name="dorsal" id="dorsal" value="{{ old('dorsal', $jugadora->dorsal) }}" 
                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border">
        </div>

        <div>
          <label for="posicio" class="block text-sm font-medium text-gray-700">Posició:</label>
          <select name="posicio" id="posicio" 
                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border">
            @php
                $posicions = ['Portera', 'Defensa', 'Migcampista', 'Davantera'];
            @endphp
            @foreach($posicions as $pos)
                <option value="{{ $pos }}" {{ old('posicio', $jugadora->posicio) == $pos ? 'selected' : '' }}>
                    {{ $pos }}
                </option>
            @endforeach
          </select>
        </div>
      </div>

      <div>
        <label for="equip_id" class="block text-sm font-medium text-gray-700">Equip:</label>
        <select name="equip_id" id="equip_id" 
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border">
          @foreach ($equips as $equip)
            <option value="{{ $equip->id }}" 
                {{-- Comprobamos si el ID del equipo coincide con el de la jugadora --}}
                {{ old('equip_id', $jugadora->equip_id) == $equip->id ? 'selected' : '' }}>
              {{ $equip->nom }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="flex items-center justify-end space-x-4 border-t pt-6">
        <a href="{{ route('jugadoras.index') }}" class="text-gray-600 hover:text-gray-900">Cancel·lar</a>
        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg shadow transition duration-150">
          Actualitzar Dades
        </button>
      </div>
    </form>
</div>
@endsection