@extends('layouts.equip')
@section('title', __('Nou Equip'))

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md" style="color: black !important;">
    <h1 class="text-2xl font-bold text-black mb-6">{{ __('Crear Equip') }}</h1>

    <form action="{{ route('equips.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="nom" class="block text-black font-bold mb-2">{{ __('Nom') }}:</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required 
                   class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black">
            @error('nom') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="titols" class="block text-black font-bold mb-2">{{ __('Títols') }}:</label>
            <input type="number" name="titols" id="titols" value="{{ old('titols') }}" required 
                   class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black">
        </div>

        <div class="mb-4">
            <label for="estadi_id" class="block text-black font-bold mb-2">{{ __('Estadi') }}:</label>
            <select name="estadi_id" id="estadi_id" 
                    class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black appearance-none">
                <option value="" class="text-gray-500">{{ __('Sense estadi') }}</option>
                @foreach($estadis as $estadi)
                    <option value="{{ $estadi->id }}" class="text-black">{{ $estadi->nom }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-6">
            <label for="escut" class="block text-black font-bold mb-2">{{ __('Escut') }} ({{ __('Imatge') }}):</label>
            <input type="file" name="escut" id="escut" class="block w-full text-black bg-white border border-gray-300 rounded cursor-pointer">
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('equips.index') }}" class="text-black hover:underline py-2">{{ __('Cancel·lar') }}</a>
            <button type="submit" class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded shadow">
                {{ __('Guardar') }}
            </button>
        </div>
    </form>
</div>
@endsection