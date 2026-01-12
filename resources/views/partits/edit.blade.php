@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- He quitado 'border border-gray-100' del contenedor principal --}}
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md">
        
        <div class="border-b pb-4 mb-6">
            <h1 class="text-2xl font-bold text-blue-900">Editar Partit</h1>
            <p class="text-gray-500 text-sm mt-1">Modifica els equips, la data o el marcador final.</p>
        </div>

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <p class="font-bold text-sm">Si us plau, revisa els errors:</p>
                <ul class="list-disc ml-5 text-sm mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('partits.update', $partit->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Selección Equipos --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Equip Local</label>
                    {{-- Cambiado border-gray-300 a border-gray-200 --}}
                    <select name="local_id" class="w-full border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                        @foreach($equips as $equip)
                            <option value="{{ $equip->id }}" {{ $partit->local_id == $equip->id ? 'selected' : '' }}>
                                {{ $equip->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Equip Visitant</label>
                    {{-- Cambiado border-gray-300 a border-gray-200 --}}
                    <select name="visitant_id" class="w-full border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                        @foreach($equips as $equip)
                            <option value="{{ $equip->id }}" {{ $partit->visitant_id == $equip->id ? 'selected' : '' }}>
                                {{ $equip->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Marcador --}}
            <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                <h3 class="text-center text-blue-800 font-bold mb-4 uppercase text-xs tracking-wider">Marcador</h3>
                <div class="flex items-center justify-center space-x-4">
                    <div class="text-center">
                        <label class="block text-xs text-gray-500 mb-1">Gols Local</label>
                        {{-- Cambiado border-gray-300 a border-gray-200 --}}
                        <input type="number" name="gols_local" value="{{ old('gols_local', $partit->gols_local) }}" min="0"
                               class="text-center text-2xl font-bold w-24 h-16 border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    </div>
                    <span class="text-2xl font-bold text-gray-400">-</span>
                    <div class="text-center">
                        <label class="block text-xs text-gray-500 mb-1">Gols Visitant</label>
                        {{-- Cambiado border-gray-300 a border-gray-200 --}}
                        <input type="number" name="gols_visitant" value="{{ old('gols_visitant', $partit->gols_visitant) }}" min="0"
                               class="text-center text-2xl font-bold w-24 h-16 border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    </div>
                </div>
            </div>

            {{-- Fecha --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Data i Hora</label>
                {{-- Cambiado border-gray-300 a border-gray-200 --}}
                <input type="datetime-local" name="data_partit" 
                       value="{{ old('data_partit', $partit->data_partit->format('Y-m-d\TH:i')) }}"
                       class="w-full border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
            </div>

            {{-- Botones --}}
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                <a href="{{ route('partits.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">Cancel·lar</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow hover:shadow-lg transition transform hover:-translate-y-0.5">
                    Guardar Canvis
                </button>
            </div>
        </form>
    </div>
</div>
@endsection