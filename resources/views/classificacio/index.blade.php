<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Classificació
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">

            <div id="alerta" class="hidden mb-4 p-2 border rounded text-sm bg-green-100 text-green-700">
                Classificació actualitzada en temps real
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b dark:border-gray-700">
                            <th class="p-3 text-gray-700 dark:text-gray-300">Pos</th>
                            <th class="p-3 text-gray-700 dark:text-gray-300">Equip</th>
                            <th class="p-3 text-gray-700 dark:text-gray-300">Punts</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($equips as $index => $equip)
                            @php
                                $stat = $stats[$equip->id] ?? null;
                                $pos = $stat['posicio'] ?? '-';
                                $punts = $stat['punts'] ?? 0;

                                $rowClass = "";
                                //Primero
                                if ($index === 0) {
                                    $rowClass = "border-l-4 border-green-500 bg-green-50 dark:bg-green-500/20";
                                }
                                //Ultimos 3
                                elseif ($index >= count($equips) - 3) {
                                    $rowClass = "border-l-4 border-red-500 bg-red-50 dark:bg-red-500/20";
                                }
                            @endphp

                            <tr data-equip-id="{{ $equip->id }}"
                                class="border-b dark:border-gray-700 dark:text-gray-300 {{ $rowClass }}">
                                <td class="p-3 font-semibold">
                                    {{ $pos }}
                                </td>
                                <td class="p-3">
                                    {{ $equip->nom }}
                                </td>
                                <td class="p-3 font-bold">
                                    {{ $punts }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        window.addEventListener('classificacio-delta', (ev) => {
            const a = document.getElementById('alerta');
            if (a) {
                a.classList.remove('hidden');
                setTimeout(() => a.classList.add('hidden'), 2500);
            }

            (ev.detail || []).forEach(item => {
                const row = document.querySelector(`[data-equip-id="${item.equip_id}"]`);
                if (!row) return;

                row.classList.remove('puja', 'baixa');



                if (item.delta > 0) row.classList.add('puja');
                if (item.delta < 0) row.classList.add('baixa');
            });

            setTimeout(() => {
                window.location.reload();
            }, 1000);
        });
    </script>

    <style>
        .puja {
            animation: flashGreen 1s;
        }

        .baixa {
            animation: flashRed 1s;
        }

        @keyframes flashGreen {
            0% {
                background-color: #d1fae5;
            }

            100% {
                background-color: transparent;
            }
        }

        @keyframes flashRed {
            0% {
                background-color: #fee2e2;
            }

            100% {
                background-color: transparent;
            }
        }
    </style>
</x-app-layout>