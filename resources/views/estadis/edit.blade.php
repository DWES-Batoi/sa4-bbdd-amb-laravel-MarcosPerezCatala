@extends('layouts.equip')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md">
        
        <div class="border-b pb-4 mb-6">
            <h1 class="text-2xl font-bold text-blue-900">Editar Estadi</h1>
            <p class="text-gray-500 text-sm mt-1">Modifica el nom, la ciutat o la capacitat.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <ul class="list-disc ml-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('estadis.update', $estadi->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Nom de l'Estadi</label>
                <input type="text" name="nom" value="{{ old('nom', $estadi->nom) }}" 
                       class="w-full border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Ciutat</label>
                <input type="text" name="ciutat" value="{{ old('ciutat', $estadi->ciutat) }}" 
                       class="w-full border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Capacitat</label>
                <input type="number" name="capacitat" value="{{ old('capacitat', $estadi->capacitat) }}" 
                       class="w-full border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
            </div>

            {{-- Botones --}}
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                <a href="{{ route('estadis.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">Cancel·lar</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow hover:shadow-lg transition transform hover:-translate-y-0.5">
                    Guardar Canvis
                </button>
            </div>
        </form>
    </div>
</div>
@endsection