<div>

    <x-search></x-search>
    <div class="grid grid-cols-3 gap-3" wire:poll.30000ms>
        @foreach ($locations as $location)
        <x-card title="{{$location->name}}">
            <div class="flex justify-between">
                <div class="py-2"><i
                        class="fas fa-{{$location->llegada_verificador != null ? 'check':'times'}} text-{{$location->llegada_verificador != null ? 'green':'gray'}}-600">
                    </i> Llegada del verificador</div>
                @if ($location->llegada_verificador == null)
                <div style="width:153px">
                    <x-button class="w-full" click="llegada({{$location->id}})">Registrar llegada</x-button>
                </div>
                @endif
            </div>
            <div class="flex justify-between">
                <div class="py-2">
                    <i
                        class="fas fa-{{$location->apertura != null ? 'check':'times'}} text-{{$location->apertura != null ? 'green':'gray'}}-600">
                    </i>
                    Inicio de votaciones
                </div>

                @if ($location->apertura == null)
                <div style="width:153px">
                    <x-button class="w-full" click="apertura({{$location->id}})">Registrar Inicio</x-button>
                </div>
                @endif
            </div>
            <div class="flex justify-between">
                <div class="py-2">
                    <i
                        class="fas fa-{{$location->cierre != null  ? 'check':'times'}} text-{{$location->cierre != null ? 'green':'gray'}}-600">
                    </i> Cierre de votaciones
                </div>
                @if ($location->cierre == null && $location->apertura != null)
                <div style="width:153px">
                    <x-button class="w-full" click="cierre({{$location->id}})">Registrar cierre</x-button>
                </div>
                @endif
            </div>
            <div class="flex justify-between">
                <div class="py-2">
                    <i
                        class="fas fa-{{$location->conteo != null  ? 'check':'times'}} text-{{$location->conteo != null  ? 'green':'gray'}}-600">
                    </i> Inició conteo de votos
                </div>
                @if ($location->conteo == null && $location->apertura != null && $location->cierre != null)
                <div style="width:153px">
                    <x-button class="w-full" click="conteo({{$location->id}})">Iniciar conteo</x-button>
                </div>
                @endif
            </div>
            <div class="relative pt-1">
                <div class="flex mb-2 items-center justify-between">
                    <div>
                        <span class="
                    text-xs
                    font-semibold
                    inline-block
                    py-1
                    px-2
                    uppercase
                    rounded-full
                    text-gray-600
                    bg-gray-200
                  ">
                            Asistencia
                        </span>
                    </div>
                    <div class="text-left">
                        <span class="text-xs font-semibold inline-block text-gray-600">
                            {{$location->guests()->whereNotNull('attendance_door_id')->count()}} de
                            {{$location->guests()->count()}}
                        </span>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-semibold inline-block text-gray-600">
                            {{$location->guests()->count() > 0
                            ?round(($location->guests()->whereNotNull('attendance_door_id')->count()/$location->guests()->count())*100,0)
                            : '0'}}%


                        </span>
                    </div>
                </div>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                    <div style="width: {{$location->guests()->count() > 0 ?round(($location->guests()->whereNotNull('attendance_door_id')->count()/$location->guests()->count())*100,0) : '0'}}%"
                        class="
                  shadow-none
                  flex flex-col
                  text-center
                  whitespace-nowrap
                  text-white
                  justify-center
                  bg-green-500
                "></div>
                </div>
            </div>
        </x-card>
        @endforeach
    </div>
</div>