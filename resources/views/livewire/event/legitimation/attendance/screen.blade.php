<div>

    <div class="w-full" style="height: 100vh">
        <div class="text-center font-bold text-3xl">
            Control de Accesos
        </div>
        <div class="flex" style="height:calc(100vh - 150px)">
            <div class="w-full flex p-3">
                <div class="w-1/3 flex flex-wrap content-center">
                    <div class="w-full relative">
                        <img src="{{ asset('img/credencial.png') }}"
                            class="max-w-full m-auto rounded-xl border border-gray-300 shadow-xl"
                            style="max-height: calc(100vh - 330px)">
                        <div class="absolute"
                            style="top: 50%; left:50%;transform: translate(-50%, -50%);-ms-transform: translate(-50%, -50%);width:30%;">
                            @if ($user)
                                <img src="{{ Storage::url($user->profile_photo_path) }}"
                                    class="max-h-full max-w-full max-h-full m-auto shadow-lg border border-gray-300 imgDNE"
                                    alt="">
                            @endif
                        </div>
                        <div class="w-full h-full mt-5">
                            <span class="font-bold text-xl">Asistencia de miembros:
                                {{ $door->location->event->guests()->where('is_member', true)->whereNotNull('attendance_door_id')->count() }}
                                de
                                {{ $door->location->event->guests()->where('is_member', true)->count() }}
                            </span>
                            <div class=" shadow-md w-full bg-gray-200 h-9 rounded">
                                @php
                                    $totalMembers = $door->location->event->guests()->where('is_member', true)->count();
                                    $attendedMembers = $door->location->event
                                        ->guests()
                                        ->where('is_member', true)
                                        ->whereNotNull('attendance_door_id')
                                        ->count();
                                    $percentage =
                                        $totalMembers > 0 ? round(($attendedMembers / $totalMembers) * 100) : 0;
                                @endphp
                                <div class="bg-green-500 text-xs leading-none text-center text-white h-full rounded py-2 font-bold text-lg"
                                    style="width: {{ $percentage }}%">
                                    {{ $percentage }}%
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="w-2/3 ml-6 mt-3">

                    <div>
                        <div class="-m-5 px-3">
                            <div class="relative z-0 w-full mb-5">
                                <input type="text" placeholder=" " autocomplete="off" id="qr-input"
                                    class="pt-3 pb-2 block w-full font-bold px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-gray-400 border-gray-200"
                                    wire:keydown.enter="get_user($event.target.value)"
                                    wire:model.debounce.500ms="qr_code" />
                                <label for="name" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">
                                    <i class="fas fa-qrcode"></i> Escanea el código QR
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="flex items-center justify-center text-center" style="height:calc(100vh - 200px)">
                        @if ($user && $message)
                            <div class="w-full">

                                <div
                                    class="text-6xl font-bold mb-4 {{ $messageType === 'entry' ? 'text-green-600' : 'text-gray-600' }}">
                                    {{ $message }}
                                </div>
                                <div class="text-4xl font-bold text-gray-800 mb-2">
                                    {{ $user->name }}
                                </div>
                                <div class="text-3xl text-gray-600 mb-4">
                                    {{ $user->username }}
                                </div>
                            </div>
                        @else
                            <div class="text-gray-400 text-4xl">
                                <i class="fas fa-qrcode text-9xl mb-6"></i>
                                <div>Escanea un código QR para registrar asistencia</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const qrInput = document.getElementById('qr-input');
        if (qrInput) {
            qrInput.focus();
        }
    });

    // Mantener el foco en el input después de escanear
    document.addEventListener('livewire:load', function() {
        const qrInput = document.getElementById('qr-input');
        if (qrInput) {
            qrInput.focus();
        }
    });

    // Re-enfocar después de cada actualización de Livewire
    Livewire.hook('message.processed', (message, component) => {
        const qrInput = document.getElementById('qr-input');
        if (qrInput) {
            setTimeout(() => {
                qrInput.focus();
            }, 100);
        }
    });
</script>
