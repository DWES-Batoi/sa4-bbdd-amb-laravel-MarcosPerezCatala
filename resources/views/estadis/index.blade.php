@extends('layouts.equip')
@section('title', "Guia d'Estadis")

@section('content')
<div class="container mx-auto px-4">
  
  {{-- Cabecera --}}
  <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-blue-800">Guia d'Estadis</h1>
      
      {{-- SOLO ADMIN: Botón de Crear --}}
      @if(auth()->user()?->role === 'administrador')
          <a href="{{ route('estadis.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
              Nou Estadi
          </a>
      @endif
  </div>

  @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
          {{ session('success') }}
      </div>
  @endif

  {{-- GRID FORZADO CON ESTILOS INLINE (CSS PURO) --}}
  {{-- Esto asegura que se pongan al lado automáticamente --}}
  <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
    @foreach ($estadis as $estadi)
      <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
        
        {{-- Cabecera de la Tarjeta --}}
        <header class="bg-gray-100 p-4 border-b border-gray-200">
          <h2 class="text-xl font-bold text-gray-800 text-center">{{ $estadi->nom }}</h2>
        </header>

        {{-- Cuerpo de la Tarjeta --}}
        <div class="p-6 text-center flex-grow">
          <p class="text-gray-700 mb-2">
              <strong class="text-gray-900">Capacitat:</strong> 
              {{ number_format($estadi->capacitat, 0, ',', '.') }} esp.
          </p>
          @if(isset($estadi->ciutat))
            <p class="text-gray-700">
                <strong class="text-gray-900">Ciutat:</strong> 
                {{ $estadi->ciutat }}
            </p>
          @endif
        </div>

        {{-- Pie de la Tarjeta (Botones) --}}
        <footer class="bg-gray-50 px-4 py-3 border-t border-gray-100 flex justify-center space-x-2">
             {{-- VER DETALLE (Público) --}}
             <a class="text-blue-600 hover:text-blue-800 font-medium px-3 py-1" href="{{ route('estadis.show', $estadi->id) }}">
                 Veure
             </a>

            {{-- SOLO ADMIN: Editar y Eliminar --}}
            @if(auth()->user()?->role === 'administrador')
                <a class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm" href="{{ route('estadis.edit', $estadi->id) }}">
                    Editar
                </a>

                <form method="POST" action="{{ route('estadis.destroy', $estadi) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm" type="submit" onclick="return confirm('Segur que vols eliminar-lo?')">
                        Eliminar
                    </button>
                </form>
            @endif
        </footer>
      </article>
    @endforeach
  </div>
</div>
@endsection