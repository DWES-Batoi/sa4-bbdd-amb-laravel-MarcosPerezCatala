@props(['nom', 'estadi', 'titols', 'escut'])

<div class="equip border rounded-lg shadow-md p-6 bg-white max-w-sm mx-auto text-center">
    
    {{-- ZONA DE IMAGEN --}}
    <div class="mb-4 flex justify-center">
        @if ($escut)
            {{-- Si hay imagen, la mostramos --}}
            <img src="{{ asset('storage/' . $escut) }}" 
                 alt="Escut de {{ $nom }}" 
                 class="h-32 w-32 object-contain">
        @else
            {{-- Si no, mostramos un placeholder --}}
            <div class="h-32 w-32 bg-gray-100 rounded-full flex items-center justify-center text-4xl border border-gray-200">
                🛡️
            </div>
        @endif
    </div>

    {{-- DATOS DEL EQUIPO --}}
    <h2 class="text-2xl font-bold text-blue-900 mb-2">{{ $nom }}</h2>
    
    <div class="text-gray-700 space-y-1">
        <p><strong>Estadi:</strong> {{ $estadi }}</p>
        <p><strong>Títols:</strong> {{ $titols }}</p>
    </div>

    {{-- Botón para volver (Opcional, pero útil en la vista detalle) --}}
    <div class="mt-6 pt-4 border-t border-gray-100">
        <a href="{{ route('equips.index') }}" class="text-sm text-blue-600 hover:underline">
            ← Tornar al llistat
        </a>
    </div>
</div>