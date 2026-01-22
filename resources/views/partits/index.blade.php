@extends('layouts.equip')

@section('content')
<div class="container mx-auto px-4">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
      <h1 class="text-3xl font-bold text-black">Calendari de Partits</h1>
      
      @if(auth()->user()?->role === 'administrador')
          <a href="{{ route('partits.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition">
              Nou Partit
          </a>
      @endif
  </div>


  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($partits as $partit)
      <article class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 flex flex-col h-full">
        
        <header class="p-3 flex justify-center bg-gray-50 border-b border-gray-100">
            <span class="bg-gray-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                {{ $partit->data_partit->format('d/m/Y H:i') }}
            </span>
        </header>

        <div class="p-6 flex justify-between items-center flex-grow">
            
            <div style="text-align: right; width: 40%;">
                <h3 class="font-bold text-gray-800 text-lg leading-tight">{{ $partit->local->nom }}</h3>
                <span class="text-xs text-gray-500 font-bold uppercase">Local</span>
            </div>

            <a href="{{ route('partits.show', $partit) }}" 
               title="Veure detalls"
               class="bg-blue-50 text-blue-800 border border-blue-200 font-black text-xl px-2 py-2 rounded-lg hover:bg-blue-100 transition shadow-sm whitespace-nowrap mx-2">
                {{ $partit->gols_local }} - {{ $partit->gols_visitant }}
            </a>

            <div style="text-align: left; width: 40%;">
                <h3 class="font-bold text-gray-800 text-lg leading-tight">{{ $partit->visitant->nom }}</h3>
                <span class="text-xs text-gray-500 font-bold uppercase">Visitant</span>
            </div>
        </div>

        <footer class="bg-gray-50 p-4 border-t border-gray-100 flex justify-center gap-2">
          @if(auth()->user()?->role === 'administrador')
              <a class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm font-medium shadow-sm transition" href="{{ route('partits.edit', $partit) }}">
                  Editar
              </a>

              <form method="POST" action="{{ route('partits.destroy', $partit) }}" class="inline">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-medium shadow-sm transition" type="submit" onclick="return confirm('Esborrar partit?')">
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