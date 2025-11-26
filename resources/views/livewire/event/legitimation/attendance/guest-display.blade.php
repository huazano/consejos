<div class="w-full bg-gradient-to-br from-blue-50 to-indigo-100" style="height: 100vh;">
    @php
        $totalMembers = $event->guests()->where('is_member', true)->count();
        $attendedMembers = $event->guests()->where('is_member', true)->whereNotNull('attendance_door_id')->count();
        $percentage = $totalMembers > 0 ? round(($attendedMembers / $totalMembers) * 100) : 0;
    @endphp

    <div class="w-full bg-gray-200 h-8 relative flex items-center justify-center">
        <div class="bg-green-500 h-full transition-all duration-500 absolute left-0 top-0" style="width: {{ $percentage }}%"></div>
        <span class="relative z-10 font-bold text-black">{{ $attendedMembers }} / {{ $totalMembers }} ({{ $percentage }}%)</span>
    </div>

    <div class="container mx-auto px-4 py-8 h-full flex items-center justify-center">
        <!-- Grid de invitados -->
        <div class="grid grid-cols-2 gap-8 w-full" style="max-height: 100vh;">
            @foreach($guests as $guest)
                <div class="bg-white rounded-2xl shadow-xl p-8 flex flex-col items-center justify-center">
                    <!-- Foto del usuario -->
                    <div class="w-56 h-56 mb-6 rounded-full overflow-hidden border-4 border-indigo-500 shadow-lg">
                        @if($guest->profile_photo_path)
                            <img src="{{ str_replace(['.jpg', '.jpeg', '.png', '.JPG', '.JPEG', '.PNG'], '.webp', Storage::url($guest->profile_photo_path)) }}"
                                 alt="{{ $guest->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                                <i class="fas fa-user text-white text-8xl"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Información del usuario -->
                    <div class="text-center">
                        <h2 class="text-4xl font-bold text-gray-800 mb-2">
                            {{ $guest->name }}
                        </h2>
                        <p class="text-2xl text-indigo-600 font-semibold">
                            {{ $guest->username }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Indicador de página -->
        <div class="absolute bottom-8 left-0 right-0">
            <div class="flex justify-center items-center space-x-2">
                @php
                    $totalGuests = $event->guests()->where('is_member', true)->count();
                    $totalPages = ceil($totalGuests / $guestsPerPage);
                @endphp
                @for($i = 0; $i < $totalPages; $i++)
                    <div class="w-3 h-3 rounded-full {{ $i === $currentPage ? 'bg-indigo-600' : 'bg-gray-400' }}"></div>
                @endfor
            </div>
        </div>
    </div>
</div>

<script>
    // Rotar automáticamente cada 5 segundos
    setInterval(function() {
        @this.call('nextPage');
    }, 5000);
</script>
