@extends('layouts.app')

@section('content')
<div class="container">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
      <h1 class="title">Listado de Jugadoras</h1>
      {{-- Botón para crear (opcional, pero útil) --}}
      <a href="{{ route('jugadoras.create') }}" class="btn btn--primary">Fitxar Jugadora</a>
  </div>

  {{-- Mensaje de éxito si existe --}}
  @if (session('success'))
      <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
          {{ session('success') }}
      </div>
  @endif

  <div class="grid-cards">
    @foreach ($jugadoras as $jugadora)
      <article class="card">
        <header class="card__header">
          <h2 class="card__title">{{ $jugadora->nom }}</h2>
          {{-- Usamos el Dorsal como distintivo --}}
          <span class="card__badge">#{{ $jugadora->dorsal }}</span>
        </header>

        <div class="card__body">
          <p><strong>Posició:</strong> {{ $jugadora->posicio }}</p>
          {{-- Mostramos el equipo usando la relación --}}
          <p><strong>Equip:</strong> {{ $jugadora->equip->nom ?? 'Sense equip' }}</p>
        </div>

        <footer class="card__footer">
          <a class="btn btn--ghost" href="{{ route('jugadoras.show', $jugadora) }}">Ver</a>
          <a class="btn btn--primary" href="{{ route('jugadoras.edit', $jugadora) }}">Editar</a>

          <form method="POST" action="{{ route('jugadoras.destroy', $jugadora) }}" class="inline">
            @csrf
            @method('DELETE')
            <button class="btn btn--danger" type="submit" onclick="return confirm('Segur que vols eliminar-la?')">Eliminar</button>
          </form>
        </footer>
      </article>
    @endforeach
  </div>
</div>
@endsection