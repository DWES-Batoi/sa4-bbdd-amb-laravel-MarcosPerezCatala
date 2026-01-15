@extends('layouts.equip')

@section('content')
<div class="container mx-auto px-4">
  
  {{-- Cabecera --}}
  <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-blue-800">Llistat d'equips</h1>
      
      {{-- SOLO ADMIN: Botón de Crear --}}
      @if(auth()->user()?->role === 'administrador')
          <a href="{{ route('equips.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
              Nou Equip
          </a>
      @endif
  </div>

  @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
          {{ session('success') }}
      </div>
  @endif

  {{-- GRID AUTOMÁTICO (CSS PURO) --}}
  <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
    @foreach ($equips as $equip)
      <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
        
        {{-- Zona de Imagen (Escudo) --}}
        <div class="p-4 flex justify-center bg-gray-50 border-b border-gray-100">
            @if($equip->escut)
                <img src="{{ asset('storage/' . $equip->escut) }}" 
                     alt="Escut de {{ $equip->nom }}" 
                     class="h-32 w-32 object-contain">
            @else
                <div class="h-32 w-32 flex items-center justify-center text-4xl bg-gray-200 rounded-full border border-gray-300">
                    🛡️
                </div>
            @endif
        </div>

        {{-- Título --}}
        <header class="p-4 text-center">
          <h2 class="text-xl font-bold text-gray-800">{{ $equip->nom }}</h2>
        </header>

        {{-- Datos --}}
        <div class="p-4 text-center flex-grow">
          <p class="text-gray-700 mb-1"><strong>Títols:</strong> {{ $equip->titols }}</p>
          <p class="text-gray-700"><strong>Estadi:</strong> {{ $equip->estadi->nom ?? 'Sense estadi' }}</p>
        </div>

        {{-- Botones --}}
        <footer class="bg-gray-50 px-4 py-3 border-t border-gray-100 flex justify-center space-x-2">
          {{-- Veure (Público) --}}
          <a class="text-blue-600 hover:text-blue-800 font-medium px-3 py-1" href="{{ route('equips.show', $equip) }}">Veure</a>
          
          {{-- Admin --}}
          @if(auth()->user()?->role === 'administrador')
              <a class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm" href="{{ route('equips.edit', $equip) }}">Editar</a>
              <form method="POST" action="{{ route('equips.destroy', $equip) }}" class="inline">
                @csrf @method('DELETE')
                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm" type="submit" onclick="return confirm('Segur?')">Eliminar</button>
              </form>
          @endif
        </footer>
      </article>
    @endforeach
  </div>
</div>
@endsection