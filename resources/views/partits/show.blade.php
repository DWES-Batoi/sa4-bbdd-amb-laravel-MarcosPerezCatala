@extends('layouts.equip')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        
        {{-- Cabecera: Fecha y Hora --}}
        <div class="bg-gray-700 text-white text-center py-4">
            <h2 class="text-xl font-bold uppercase tracking-wider">
                {{ $partit->data_partit->format('d/m/Y') }}
            </h2>
            <p class="text-gray-300 text-sm mt-1">
                {{ $partit->data_partit->format('H:i') }} H
            </p>
        </div>

        {{-- Cuerpo: El Marcador Gigante --}}
        <div class="p-8 md:p-12 flex flex-col md:flex-row items-center justify-between">
            
            {{-- Equipo Local --}}
            <div class="flex-1 text-center mb-6 md:mb-0">
                <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $partit->local->nom }}</h3>
                <span class="inline-block bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded uppercase font-bold">Local</span>
            </div>

            {{-- Resultado Central --}}
            <div class="mx-8 bg-blue-50 rounded-2xl px-8 py-6 border border-blue-100 shadow-inner">
                <span class="text-6xl font-black text-blue-900">
                    {{ $partit->gols_local }} - {{ $partit->gols_visitant }}
                </span>
            </div>

            {{-- Equipo Visitante --}}
            <div class="flex-1 text-center mt-6 md:mt-0">
                <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $partit->visitant->nom }}</h3>
                <span class="inline-block bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded uppercase font-bold">Visitant</span>
            </div>

        </div>

        {{-- Footer: Botones de Acción --}}
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-center space-x-4">
            {{-- Botón Volver (Público) --}}
            <a href="{{ route('partits.index') }}" class="text-gray-600 hover:text-gray-900 font-medium flex items-center px-4 py-2">
                ← Tornar al llistat
            </a>
            
            {{-- Botón Editar (SOLO ADMIN) --}}
            @if(auth()->user()?->role === 'administrador')
                <a href="{{ route('partits.edit', $partit) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded shadow transition">
                    Editar Resultat
                </a>
            @endif
        </div>

    </div>
</div>
@endsection 