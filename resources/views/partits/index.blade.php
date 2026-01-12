@extends('layouts.app')

@section('content')
<div class="container">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
      <h1 class="title">Calendari de Partits</h1>
      <a href="{{ route('partits.create') }}" class="btn btn--primary">Nou Partit</a>
  </div>

  @if (session('success'))
      <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
          {{ session('success') }}
      </div>
  @endif

  <div class="grid-cards">
    @foreach ($partits as $partit)
      <article class="card" style="text-align: center;">
        
        {{-- Header con la fecha --}}
        <header class="card__header" style="justify-content: center;">
            <span class="card__badge" style="background: #666;">
                {{ $partit->data_partit->format('d/m/Y H:i') }}
            </span>
        </header>

        {{-- Cuerpo: Equipo A vs Equipo B --}}
        <div class="card__body" style="display: flex; justify-content: space-between; align-items: center; padding: 1.5rem;">
            
            {{-- Local --}}
            <div style="text-align: right; width: 40%;">
                <h3 style="font-weight: bold; color: #2d3748;">{{ $partit->local->nom }}</h3>
                <span style="font-size: 0.8rem; color: #718096;">Local</span>
            </div>

            {{-- RESULTADO CLICKABLE (Enlace al SHOW) --}}
            <a href="{{ route('partits.show', $partit) }}" 
               title="Veure detalls del partit"
               style="text-decoration: none; font-weight: 900; font-size: 1.5rem; color: #2b6cb0; background: #ebf8ff; padding: 5px 15px; border-radius: 10px; transition: transform 0.2s; display: inline-block;"
               onmouseover="this.style.transform='scale(1.1)'" 
               onmouseout="this.style.transform='scale(1)'">
                {{ $partit->gols_local }} - {{ $partit->gols_visitant }}
            </a>

            {{-- Visitante --}}
            <div style="text-align: left; width: 40%;">
                <h3 style="font-weight: bold; color: #2d3748;">{{ $partit->visitant->nom }}</h3>
                <span style="font-size: 0.8rem; color: #718096;">Visitant</span>
            </div>
        </div>

        {{-- Footer con EDITAR y ELIMINAR --}}
        <footer class="card__footer" style="justify-content: center; gap: 10px;">
          
          {{-- Botón Editar --}}
          <a class="btn btn--primary" href="{{ route('partits.edit', $partit) }}">Editar</a>

          {{-- Botón Eliminar --}}
          <form method="POST" action="{{ route('partits.destroy', $partit) }}" class="inline">
            @csrf
            @method('DELETE')
            <button class="btn btn--danger" type="submit" onclick="return confirm('Esborrar partit?')">Eliminar</button>
          </form>
        </footer>
      </article>
    @endforeach
  </div>
</div>
@endsection