@extends('layouts.equip')
@section('title', __('Editar Resultat'))

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md" style="color: black !important;">
        <h1 class="text-2xl font-bold text-black mb-6">{{ __('Resultat final') }}: {{ $partit->local->nom }} vs
            {{ $partit->visitant->nom }}</h1>

        <form action="{{ route('partits.update', $partit) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="local_id" value="{{ $partit->local_id }}">
            <input type="hidden" name="visitant_id" value="{{ $partit->visitant_id }}">
            <input type="hidden" name="data_partit" value="{{ $partit->data_partit }}">

            <div class="mb-4">
                <label for="gols_local" class="block text-black font-bold mb-2">{{ __('Gols') }} {{ __('Local') }}
                    ({{ $partit->local->nom }}):</label>
                <input type="number" name="gols_local" id="gols_local" value="{{ old('gols_local', $partit->gols_local) }}"
                    min="0" required
                    class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black">
            </div>

            <div class="mb-6">
                <label for="gols_visitant" class="block text-black font-bold mb-2">{{ __('Gols') }} {{ __('Visitant') }}
                    ({{ $partit->visitant->nom }}):</label>
                <input type="number" name="gols_visitant" id="gols_visitant"
                    value="{{ old('gols_visitant', $partit->gols_visitant) }}" min="0" required
                    class="w-full border-gray-300 rounded-md shadow-sm text-black bg-white focus:border-black focus:ring-black">
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('partits.index') }}" class="text-black hover:underline py-2">{{ __('Cancel·lar') }}</a>
                <button type="submit" class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded shadow">
                    {{ __('Actualitzar') }}
                </button>
            </div>
        </form>
    </div>
@endsection