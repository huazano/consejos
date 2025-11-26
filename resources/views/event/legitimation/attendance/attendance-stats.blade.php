<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div class="w-full bg-gradient-to-br from-blue-50 to-indigo-100" style="height: 100vh;">
        <div class="container mx-auto px-8 py-12 h-full overflow-y-auto">
            <!-- Lista de delegaciones con barras -->
            <div class="space-y-6">
                @php
                    $delegations = [
                        '01' => 'BAJA CALIFORNIA',
                        '02' => 'BAJA CALIFORNIA SUR',
                        '03' => 'SONORA',
                        '04' => 'SINALOA',
                        '05' => 'PLANTAS NOROESTE',
                        '06' => 'NORTE',
                        '07A' => 'GOLFO NORTE I',
                        '07B' => 'GOLFO NORTE II',
                        '08' => 'JALISCO-NAYARIT',
                        '09' => 'BAJIO',
                        '10' => 'GOLFO CENTRO',
                        '11A' => 'CENTRO OCCIDENTE A',
                        '11B' => 'CENTRO OCCIDENTE B',
                        '12' => 'CENTRO SUR',
                        '13' => 'CENTRO ORIENTE',
                        '14' => 'GENERACION Y TRANSMISION CENTRAL',
                        '15' => 'VALLE DE MEXICO NORTE',
                        '16' => 'VALLE DE MEXICO CENTRO',
                        '17' => 'VALLE DE MEXICO SUR',
                        '18A' => 'ORIENTE',
                        '18B' => 'NUCLEOELECTRICAS',
                        '19' => 'SURESTE',
                        '20' => 'PENINSULAR',
                        '21' => 'CORPORATIVO',
                        'CEN' => 'COMITE EJECUTIVO NACIONAL',
                    ];
                @endphp

                @foreach($delegations as $code => $name)
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between mb-3">
                            <!-- Código y nombre -->
                            <div class="flex items-center space-x-4 w-2/3">
                                <span class="text-4xl font-bold text-indigo-600 min-w-[120px]">{{ $code }}</span>
                                <span class="text-3xl font-semibold text-gray-800">{{ $name }}</span>
                            </div>

                            <!-- Input para actualizar cantidad -->
                            <div class="flex items-center space-x-4">
                                <input
                                    type="number"
                                    min="0"
                                    value="0"
                                    data-delegation="{{ $code }}"
                                    class="delegation-input w-32 text-4xl font-bold text-center border-2 border-indigo-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                                    oninput="updateBar(this)"
                                >
                            </div>
                        </div>

                        <!-- Barra de progreso -->
                        <div class="relative w-full h-16 bg-gray-200 rounded-lg overflow-hidden">
                            <div
                                id="bar-{{ $code }}"
                                class="h-full bg-gradient-to-r from-green-400 to-green-600 transition-all duration-500 ease-out flex items-center justify-end pr-6"
                                style="width: 0%"
                            >
                                <span id="count-{{ $code }}" class="text-4xl font-bold text-white drop-shadow-lg" style="display: none;"></span>
                            </div>
                            <div id="empty-{{ $code }}" class="absolute inset-0 flex items-center justify-center">
                                <span class="text-3xl text-gray-400">0</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Total general -->
            <div class="mt-12 text-center py-8">
                <div class="text-gray-600 text-4xl font-semibold mb-4">TOTAL</div>
                <div id="total-count" class="text-9xl font-bold text-indigo-600">0</div>
            </div>
        </div>
    </div>

    <script>
        function updateBar(input) {
            const code = input.dataset.delegation;
            const count = Math.max(0, parseInt(input.value) || 0);

            const bar = document.getElementById('bar-' + code);
            const countSpan = document.getElementById('count-' + code);
            const emptySpan = document.getElementById('empty-' + code);

            if (count > 0) {
                bar.style.width = '100%';
                countSpan.textContent = count;
                countSpan.style.display = 'block';
                emptySpan.style.display = 'none';
            } else {
                bar.style.width = '0%';
                countSpan.style.display = 'none';
                emptySpan.style.display = 'flex';
            }

            // Actualizar total
            updateTotal();
        }

        function updateTotal() {
            const inputs = document.querySelectorAll('.delegation-input');
            let total = 0;
            inputs.forEach(input => {
                total += Math.max(0, parseInt(input.value) || 0);
            });
            document.getElementById('total-count').textContent = total;
        }
    </script>
</body>
</html>
