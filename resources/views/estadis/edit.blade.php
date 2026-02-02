@extends('layouts.equip')
@section('title', __('Editar'))

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md" style="color: black !important;">
    <h1 class="text-2xl font-bold text-black mb-6">{{ __('Editar') }}: {{ $estadi->nom }}</h1>

    <form action="{{ route('estadis.update', $estadi) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nom" class="block text-black font-bold mb-2">{{ __('Nom') }}:</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $estadi->nom) }}" required 
                   class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black">
        </div>

        <div class="mb-4">
            <label for="capacitat" class="block text-black font-bold mb-2">{{ __('Capacitat') }}:</label>
            <input type="number" name="capacitat" id="capacitat" value="{{ old('capacitat', $estadi->capacitat) }}" required 
                   class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black">
        </div>

        <div class="mb-6">
            <label for="ciutat" class="block text-black font-bold mb-2">{{ __('Ciutat') }}:</label>
            <input type="text" name="ciutat" id="ciutat" value="{{ old('ciutat', $estadi->ciutat) }}" 
                   class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black">
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('estadis.index') }}" class="text-black hover:underline py-2">{{ __('Cancel·lar') }}</a>
            <button type="submit" class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded shadow">
                {{ __('Actualitzar') }}
            </button>
        </div>
    </form>
</div>
@endsection