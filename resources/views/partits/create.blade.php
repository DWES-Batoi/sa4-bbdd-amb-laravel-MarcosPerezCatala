@extends('layouts.app')

@section('title', 'Nou Partit')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-blue-800 border-b pb-4">Programar Nou Partit</h1>

    {{-- Mostrar errores de validación (Ej: Mismo equipo local y visitante) --}}
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
            <p class="font-bold">Atenció:</p>
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('partits.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Equipo Local --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Equip Local</label>
                <select name="local_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500">
                    <option value="" disabled selected>-- Tria Local --</option>
                    @foreach($equips as $equip)
                        <option value="{{ $equip->id }}" {{ old('local_id') == $equip->id ? 'selected' : '' }}>
                            {{ $equip->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Equipo Visitante --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Equip Visitant</label>
                <select name="visitant_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500">
                    <option value="" disabled selected>-- Tria Visitant --</option>
                    @foreach($equips as $equip)
                        <option value="{{ $equip->id }}" {{ old('visitant_id') == $equip->id ? 'selected' : '' }}>
                            {{ $equip->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Fecha y Hora --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Data i Hora</label>
            <input type="datetime-local" name="data_partit" value="{{ old('data_partit') }}"
                   class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm">
        </div>

        {{-- Resultados Iniciales (Opcional, por defecto 0-0) --}}
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Gols Local</label>
                <input type="number" name="gols_local" value="{{ old('gols_local', 0) }}" min="0"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Gols Visitant</label>
                <input type="number" name="gols_visitant" value="{{ old('gols_visitant', 0) }}" min="0"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            </div>
        </div>

        {{-- Botones --}}
        <div class="flex justify-end pt-4">
            <a href="{{ route('partits.index') }}" class="text-gray-600 mr-4 py-2">Cancel·lar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow">
                Guardar Partit
            </button>
        </div>
    </form>
</div>
@endsection