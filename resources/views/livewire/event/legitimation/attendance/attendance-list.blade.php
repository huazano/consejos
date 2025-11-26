<div class="min-h-screen py-8 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header con estadísticas -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Lista de Asistencia</h1>

            <!-- Resumen de estadísticas -->
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="bg-blue-50 rounded-lg p-4 border-l-4 border-blue-500">
                    <div class="text-blue-600 text-sm font-semibold mb-1">TOTAL MIEMBROS</div>
                    <div class="text-3xl font-bold text-blue-700">{{ $totalMembers }}</div>
                </div>
                <div class="bg-green-50 rounded-lg p-4 border-l-4 border-green-500">
                    <div class="text-green-600 text-sm font-semibold mb-1">CON ASISTENCIA</div>
                    <div class="text-3xl font-bold text-green-700">{{ $attendedMembers }}</div>
                </div>
                <div class="bg-red-50 rounded-lg p-4 border-l-4 border-red-500">
                    <div class="text-red-600 text-sm font-semibold mb-1">SIN ASISTENCIA</div>
                    <div class="text-3xl font-bold text-red-700">{{ $notAttendedMembers }}</div>
                </div>
            </div>

            <!-- Barra de progreso -->
            @php
                $percentage = $totalMembers > 0 ? round(($attendedMembers / $totalMembers) * 100) : 0;
            @endphp
            <div class="w-full bg-gray-200 h-8 rounded-lg relative flex items-center justify-center mb-6">
                <div class="bg-green-500 h-full transition-all duration-500 absolute left-0 top-0 rounded-lg" style="width: {{ $percentage }}%"></div>
                <span class="relative z-10 font-bold text-black">{{ $percentage }}% de asistencia</span>
            </div>

            <!-- Filtros y búsqueda -->
            <div class="flex flex-wrap gap-4">
                <!-- Búsqueda -->
                <div class="flex-1 min-w-[300px]">
                    <input
                        type="text"
                        wire:model.debounce.500ms="search"
                        placeholder="Buscar por nombre o clave..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                    >
                </div>

                <!-- Filtro de estado -->
                <div class="flex gap-2">
                    <button
                        wire:click="$set('filterStatus', 'all')"
                        class="px-4 py-2 rounded-lg font-semibold transition {{ $filterStatus === 'all' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}"
                    >
                        Todos ({{ $totalMembers }})
                    </button>
                    <button
                        wire:click="$set('filterStatus', 'attended')"
                        class="px-4 py-2 rounded-lg font-semibold transition {{ $filterStatus === 'attended' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}"
                    >
                        Con Asistencia ({{ $attendedMembers }})
                    </button>
                    <button
                        wire:click="$set('filterStatus', 'not_attended')"
                        class="px-4 py-2 rounded-lg font-semibold transition {{ $filterStatus === 'not_attended' ? 'bg-red-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}"
                    >
                        Sin Asistencia ({{ $notAttendedMembers }})
                    </button>
                </div>
            </div>
        </div>

        <!-- Tabla de invitados -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-indigo-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold">#</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Foto</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Nombre</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Clave</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold">Estado</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Hora de Entrada</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($guests as $index => $guest)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-700">{{ $guests->firstItem() + $index }}</td>
                                <td class="px-6 py-4">
                                    @if($guest->profile_photo_path)
                                        <img src="{{ str_replace(['.jpg', '.jpeg', '.png', '.JPG', '.JPEG', '.PNG'], '.webp', Storage::url($guest->profile_photo_path)) }}"
                                             alt="{{ $guest->name }}"
                                             class="w-12 h-12 rounded-full object-cover border-2 border-gray-300">
                                    @else
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-800">{{ $guest->name }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $guest->username }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if($guest->attendance_door_id)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Presente
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1"></i>
                                            Ausente
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    @if($guest->attendance_date)
                                        {{ \Carbon\Carbon::parse($guest->attendance_date)->format('d/m/Y H:i:s') }}
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <i class="fas fa-inbox text-4xl mb-2"></i>
                                    <div class="text-lg">No se encontraron registros</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $guests->links() }}
            </div>
        </div>
    </div>
</div>
