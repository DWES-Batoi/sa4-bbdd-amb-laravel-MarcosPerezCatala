@extends('layouts.app')
@section('title', 'Afegir nou equip')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Afegir nou equip</h1>

  @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- ¡IMPORTANTE! Añadido enctype="multipart/form-data" --}}
  <form action="{{ route('equips.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

    {{-- Campo Nombre --}}
    <div>
      <label for="nom" class="block font-bold">Nom:</label>
      <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="border p-2 w-full rounded">
    </div>

    {{-- Campo Estadio --}}
    <div>
      <label for="estadi_id" class="block font-bold">Estadi:</label>
      <select name="estadi_id" id="estadi_id" class="border p-2 w-full rounded">
        @foreach ($estadis as $estadi)
          <option value="{{ $estadi->id }}" {{ old('estadi_id') == $estadi->id ? 'selected' : '' }}>
            {{ $estadi->nom }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- Campo Títulos --}}
    <div>
      <label for="titols" class="block font-bold">Títols:</label>
      <input type="number" name="titols" id="titols" value="{{ old('titols') }}" class="border p-2 w-full rounded">
    </div>

    {{-- ¡NUEVO! Campo Escudo --}}
    <div>
      <label for="escut" class="block font-bold">Escut (Imatge):</label>
      <input type="file" name="escut" id="escut" class="border p-2 w-full rounded bg-white">
    </div>

    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
      Afegir
    </button>
  </form>
@endsection