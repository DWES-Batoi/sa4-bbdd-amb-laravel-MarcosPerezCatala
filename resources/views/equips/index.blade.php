@extends('layouts.app')

@section('content')
<div class="container">
  
  {{-- Cabecera con botón de Crear --}}
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
      <h1 class="title">Llistat d'equips</h1>
      <a href="{{ route('equips.create') }}" class="btn btn--primary">Nou Equip</a>
  </div>

  {{-- Mensaje de éxito --}}
  @if (session('success'))
      <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
          {{ session('success') }}
      </div>
  @endif

  <div class="grid-cards">
    @foreach ($equips as $equip)
      <article class="card">
        
        {{-- ZONA DE IMAGEN --}}
        <div style="text-align: center; padding: 15px 0;">
            @if($equip->escut)
                <img src="{{ asset('storage/' . $equip->escut) }}" 
                     alt="Escut de {{ $equip->nom }}" 
                     style="width: 100px; height: 100px; object-fit: contain; margin: 0 auto;">
            @else
                {{-- Placeholder --}}
                <div style="font-size: 50px;">🛡️</div>
            @endif
        </div>

        <header class="card__header" style="justify-content: center;">
          <h2 class="card__title">{{ $equip->nom }}</h2>
        </header>

        <div class="card__body" style="text-align: center;">
          <p><strong>Títols:</strong> {{ $equip->titols }}</p>
          <p><strong>Estadi:</strong> {{ $equip->estadi->nom ?? 'Sense estadi' }}</p>
        </div>

        <footer class="card__footer" style="gap: 10px; justify-content: center;">
          {{-- Botón VEURE (Activado) --}}
          <a class="btn btn--ghost" href="{{ route('equips.show', $equip) }}">Veure</a>
          
          {{-- Botón EDITAR --}}
          <a class="btn btn--primary" href="{{ route('equips.edit', $equip) }}">Editar</a>

          {{-- Botón ELIMINAR --}}
          <form method="POST" action="{{ route('equips.destroy', $equip) }}" class="inline">
            @csrf
            @method('DELETE')
            <button class="btn btn--danger" type="submit" onclick="return confirm('Segur que vols eliminar-lo?')">Eliminar</button>
          </form>
        </footer>
      </article>
    @endforeach
  </div>
</div>
@endsection