@extends('layouts.equip')

@section('content')
<div class="container mx-auto px-4">
  
  {{-- Cabecera (Igual que Estadis: text-blue-800) --}}
  <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-blue-800">{{ __('Llistat de Jugadores') }}</h1>
      
      @if(auth()->user()?->role === 'administrador')
          <a href="{{ route('jugadoras.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
              {{ __('Fitxar Jugadora') }}
          </a>
      @endif
  </div>

  @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
          {{ session('success') }}
      </div>
  @endif

  {{-- GRID FORZADO (Igual que Estadis) --}}
  <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
    @foreach ($jugadoras as $jugadora)
      <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
        
        {{-- Cabecera de la Tarjeta (Gris claro con texto gris oscuro) --}}
        <header class="bg-gray-100 p-4 border-b border-gray-200 flex justify-between items-center">
          <h2 class="text-xl font-bold text-gray-800">{{ $jugadora->nom }}</h2>
          {{-- Badge del dorsal en tonos azules acorde al tema --}}
          <span class="bg-blue-100 text-blue-800 text-sm font-bold px-3 py-1 rounded-full border border-blue-200">
              #{{ $jugadora->dorsal }}
          </span>
        </header>

        {{-- Cuerpo de la Tarjeta (Textos en grises legibles) --}}
        <div class="p-6 text-center flex-grow">
          <p class="text-gray-700 mb-2">
              <strong class="text-gray-900">{{ __('Posició') }}:</strong> 
              {{ __($jugadora->posicio) }}
          </p>
          <p class="text-gray-700">
              <strong class="text-gray-900">{{ __('Equip') }}:</strong> 
              <span class="text-blue-600 font-medium">
                  {{ $jugadora->equip->nom ?? __('Sense equip') }}
              </span>
          </p>
        </div>

        {{-- Pie de la Tarjeta (Botones idénticos a Estadis) --}}
        <footer class="bg-gray-50 px-4 py-3 border-t border-gray-100 flex justify-center space-x-2">
          {{-- Veure (Link azul) --}}
          <a class="text-blue-600 hover:text-blue-800 font-medium px-3 py-1" href="{{ route('jugadoras.show', $jugadora) }}">
             {{ __('Veure') }}
          </a>
          
          @if(auth()->user()?->role === 'administrador')
              {{-- Editar (Azul solido) --}}
              <a class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm" href="{{ route('jugadoras.edit', $jugadora) }}">
                 {{ __('Editar') }}
              </a>

              {{-- Eliminar (Rojo solido) --}}
              <form method="POST" action="{{ route('jugadoras.destroy', $jugadora) }}" class="inline">
                @csrf @method('DELETE')
                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm" type="submit" onclick="return confirm('{{ __('Segur?') }}')">
                    {{ __('Eliminar') }}
                </button>
              </form>
          @endif
        </footer>
      </article>
    @endforeach
  </div>
</div>
@endsection