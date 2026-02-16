@extends('layouts.equip')
@section('title', "Detall de la Jugadora")

@section('content')
    <div class="max-w-2xl mx-auto">
        {{-- Enlace para volver --}}
        <a href="{{ route('jugadoras.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Tornar al
            llistat</a>

        {{-- Componente de ficha de jugadora --}}
        <x-jugadora :nom="$jugadora->nom" :dorsal="$jugadora->dorsal" :posicio="$jugadora->posicio"
            :equip="$jugadora->equip->nom ?? 'Sense equip'" />

        {{-- SOLO ADMIN: Botón de Editar --}}
        @if(auth()->user()?->role === 'administrador')
            <div class="mt-6 flex space-x-3">
                <a href="{{ route('jugadoras.edit', $jugadora->id) }}"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    Editar dades
                </a>
            </div>
        @endif
    </div>
@endsection