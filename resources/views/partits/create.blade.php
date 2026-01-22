@extends('layouts.equip')
@section('title', __('Nou Partit'))

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md" style="color: black !important;">
    <h1 class="text-2xl font-bold text-black mb-6">{{ __('Nou Partit') }}</h1>

    <form action="{{ route('partits.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="data_partit" class="block text-black font-bold mb-2">{{ __('Data i Hora') }}:</label>
            <input type="datetime-local" name="data_partit" id="data_partit" value="{{ old('data_partit') }}" required 
                   class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black">
        </div>

        <div class="mb-4">
            <label for="local_id" class="block text-black font-bold mb-2">{{ __('Local') }}:</label>
            <select name="local_id" id="local_id" required 
                    class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black appearance-none">
                <option value="" disabled selected class="text-gray-500">{{ __('Selecciona equip') }}</option>
                @foreach($equips as $equip)
                    <option value="{{ $equip->id }}" class="text-black">{{ $equip->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label for="visitant_id" class="block text-black font-bold mb-2">{{ __('Visitant') }}:</label>
            <select name="visitant_id" id="visitant_id" required 
                    class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black appearance-none">
                <option value="" disabled selected class="text-gray-500">{{ __('Selecciona equip') }}</option>
                @foreach($equips as $equip)
                    <option value="{{ $equip->id }}" class="text-black">{{ $equip->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('partits.index') }}" class="text-black hover:underline py-2">{{ __('Cancel·lar') }}</a>
            <button type="submit" class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded shadow">
                {{ __('Crear Partit') }}
            </button>
        </div>
    </form>
</div>
@endsection