@extends('layouts.equip')
@section('title', "Nou Partit")

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-blue-800 mb-6">Programar Nou Partit</h1>

    <form action="{{ route('partits.store') }}" method="POST">
        @csrf

        {{-- Data i Hora --}}
        <div class="mb-4">
            <label for="data_partit" class="block text-gray-700 font-bold mb-2">Data i Hora:</label>
            <input type="datetime-local" name="data_partit" id="data_partit" value="{{ old('data_partit') }}" required 
                   class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        {{-- Local --}}
        <div class="mb-4">
            <label for="local_id" class="block text-gray-700 font-bold mb-2">Equip Local:</label>
            <select name="local_id" id="local_id" required class="w-full border-gray-300 rounded-md shadow-sm">
                <option value="" disabled selected>Selecciona local</option>
                @foreach($equips as $equip)
                    <option value="{{ $equip->id }}">{{ $equip->nom }}</option>
                @endforeach
            </select>
        </div>

        {{-- Visitant --}}
        <div class="mb-6">
            <label for="visitant_id" class="block text-gray-700 font-bold mb-2">Equip Visitant:</label>
            <select name="visitant_id" id="visitant_id" required class="w-full border-gray-300 rounded-md shadow-sm">
                <option value="" disabled selected>Selecciona visitant</option>
                @foreach($equips as $equip)
                    <option value="{{ $equip->id }}">{{ $equip->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('partits.index') }}" class="text-gray-600 hover:underline py-2">Cancel·lar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                Crear Partit
            </button>
        </div>
    </form>
</div>
@endsection