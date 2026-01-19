@extends('layouts.equip')
@section('title', __('Editar'))

@section('content')
  <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md" style="color: black !important;">
    <h1 class="text-2xl font-bold text-black mb-6">{{ __('Editar') }}: {{ $jugadora->nom }}</h1>

    <form action="{{ route('jugadoras.update', $jugadora) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label for="nom" class="block text-black font-bold mb-2">{{ __('Nom') }}:</label>
        <input type="text" name="nom" id="nom" value="{{ old('nom', $jugadora->nom) }}" required
          class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black">
      </div>

      <div class="mb-4">
        <label for="dorsal" class="block text-black font-bold mb-2">{{ __('Dorsal') }}:</label>
        <input type="number" name="dorsal" id="dorsal" value="{{ old('dorsal', $jugadora->dorsal) }}" required
          class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black">
      </div>

      <div class="mb-4">
        <label for="posicio" class="block text-black font-bold mb-2">{{ __('Posició') }}:</label>
        <select name="posicio" id="posicio" required
          class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black appearance-none">
          @foreach(['Portera', 'Defensa', 'Migcampista', 'Davantera'] as $pos)
            <option value="{{ $pos }}" {{ $jugadora->posicio == $pos ? 'selected' : '' }} class="text-black">
              {{ __($pos) }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-6">
        <label for="equip_id" class="block text-black font-bold mb-2">{{ __('Equip') }}:</label>
        <select name="equip_id" id="equip_id" required
          class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black appearance-none">
          @foreach($equips as $equip)
            <option value="{{ $equip->id }}" {{ $jugadora->equip_id == $equip->id ? 'selected' : '' }} class="text-black">
              {{ $equip->nom }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="flex justify-end gap-4">
        <a href="{{ route('jugadoras.index') }}" class="text-black hover:underline py-2">{{ __('Cancel·lar') }}</a>
        <button type="submit" class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded shadow">
          {{ __('Actualitzar') }}
        </button>
      </div>
    </form>
  </div>
@endsection