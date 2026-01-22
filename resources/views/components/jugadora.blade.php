@props([
    'nom',
    'dorsal',
    'posicio',
    'equip'
])

<div class="border rounded-lg shadow-md p-6 bg-white flex items-center space-x-4">
    <div class="bg-blue-800 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold">
        {{ $dorsal }}
    </div>
    <div>
        <h2 class="text-xl font-bold text-blue-800">{{ $nom }}</h2>
        <p class="text-gray-600"><strong>Posició:</strong> {{ $posicio }}</p>
        <p class="text-gray-600"><strong>Equip:</strong> {{ $equip }}</p>
    </div>
</div>