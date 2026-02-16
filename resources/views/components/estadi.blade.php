@props([
    'nom',
    'capacitat',
    'equips' => collect(),
    'descripcio' => null,
])

<div class="estadi border rounded-lg shadow-md p-4 bg-white dark:bg-gray-800">
  <h2 class="text-xl font-bold text-blue-800 dark:text-blue-400 mb-2">{{ $nom }}</h2>

  <p class="text-gray-700 dark:text-gray-300"><strong>Capacitat:</strong> {{ number_format($capacitat, 0, ',', '.') }} espectadors</p>

  <p class="text-gray-700 dark:text-gray-300">
    <strong>Equips:</strong>
    {{ $equips->count() }}
  </p>

  <div class="mt-6 p-4 rounded-xl border border-blue-100 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-700 dark:to-gray-600 shadow-sm">
      <h3 class="flex items-center gap-2 text-lg font-semibold text-indigo-900 dark:text-indigo-100 mb-2">
          <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
          </svg>
          Descripció (IA local)
      </h3>
      @if($descripcio)
        <p class="text-gray-700 dark:text-gray-200 leading-relaxed italic">
            {{ $descripcio }}
        </p>
      @else
        <div class="flex items-center gap-2 text-amber-600 dark:text-amber-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-sm font-medium">No s’ha pogut generar la descripció ara mateix. Torna-ho a provar més tard.</p>
        </div>
      @endif
  </div>
</div>
