<div wire:poll.120000ms>
    <div class="grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 px-4 mb-5">
        <!-- SMALL CARD ROUNDED -->
        <div wire:click="display('status')"
            class="bg-{{$view == 'status' ? 'red-50':'gray-100'}} border-{{$view == 'status' ? 'red-900':'gray-600'}} bg-opacity-95 border-opacity-60 | p-4 border-solid rounded-3xl border-2 | flex justify-between cursor-pointer | hover:bg-gray-200  hover:border-gray-700 | transition-colors duration-500">
            <img class="w-16 h-16 object-cover" src="{{asset('svg/status.svg')}}" alt="" />
            <div class="flex flex-col justify-center">
                <p class="text-gray-900 dark:text-gray-300 font-semibold text-xl">Estado de las sedes</p>
            </div>
        </div>
        <div wire:click="display('attendance')"
            class="bg-{{$view == 'attendance' ? 'red-50':'gray-100'}} border-{{$view == 'attendance' ? 'red-900':'gray-600'}} bg-opacity-95 border-opacity-60 | p-4 border-solid rounded-3xl border-2 | flex justify-between cursor-pointer | hover:bg-gray-200  hover:border-gray-700 | transition-colors duration-500">
            <img class="w-16 h-16 object-cover" src="{{asset('svg/attendant-list.svg')}}" alt="" />
            <div class="flex flex-col justify-center">
                <p class="text-gray-900 dark:text-gray-300 font-semibold text-xl">Asistencia de las sedes</p>
            </div>
        </div>
        <div wire:click="display('attendance2')"
            class="bg-{{$view == 'attendance2' ? 'red-50':'gray-100'}} border-{{$view == 'attendance2' ? 'red-900':'gray-600'}} bg-opacity-95 border-opacity-60 | p-4 border-solid rounded-3xl border-2 | flex justify-between cursor-pointer | hover:bg-gray-200  hover:border-gray-700 | transition-colors duration-500">
            <img class="w-16 h-16 object-cover" src="{{asset('svg/organization.svg')}}" alt="" />
            <div class="flex flex-col justify-center">
                <p class="text-gray-900 dark:text-gray-300 font-semibold text-xl">Asistencia por coordinación</p>
            </div>
        </div>
        <div wire:click="display('count')"
            class="bg-{{$view == 'count' ? 'red-50':'gray-100'}} border-{{$view == 'count' ? 'red-900':'gray-600'}} bg-opacity-95 border-opacity-60 | p-4 border-solid rounded-3xl border-2 | flex justify-between cursor-pointer | hover:bg-gray-200  hover:border-gray-700 | transition-colors duration-500">
            <img class="w-16 h-16 object-cover" src="{{asset('svg/results.svg')}}" alt="" />
            <div class="flex flex-col justify-center">
                <p class="text-gray-900 dark:text-gray-300 font-semibold text-xl">Preliminar de votaciones por sede</p>
            </div>
        </div>
        <div wire:click="display('count2')"
            class="bg-{{$view == 'count2' ? 'red-50':'gray-100'}} border-{{$view == 'count2' ? 'red-900':'gray-600'}} bg-opacity-95 border-opacity-60 | p-4 border-solid rounded-3xl border-2 | flex justify-between cursor-pointer | hover:bg-gray-200  hover:border-gray-700 | transition-colors duration-500">
            <img class="w-16 h-16 object-cover" src="{{asset('svg/results.svg')}}" alt="" />
            <div class="flex flex-col justify-center">
                <p class="text-gray-900 dark:text-gray-300 font-semibold text-xl">Preliminar de votaciones por
                    coordinación
                </p>
            </div>
        </div>
    </div>

    @if ($view == 'status')
    <div>
        <x-card icon="fab fa-searchengin" title="Llegada del verificador por sede">
            <div class="flex gap-5 flex-wrap">
                @foreach ($locations as $location)
                <div
                    class="w-12 h-12 text-center bg-{{$location->llegada_verificador != null ? 'green':'gray'}}-600 text-white rounded-full flex content-center flex-wrap justify-center font-bold text-xl">
                    <div>{{$location->name}}</div>
                </div>
                @endforeach
            </div>
        </x-card>

        <x-card icon="fas fa-play" title="Inicio del proceso de votación">
            <div class="flex gap-5 flex-wrap">
                @foreach ($locations as $location)
                <div
                    class="w-12 h-12 text-center bg-{{$location->apertura != null ? 'green':'gray'}}-600 text-white rounded-full flex content-center flex-wrap justify-center font-bold text-xl">
                    <div>{{$location->name}}</div>
                </div>
                @endforeach
            </div>
        </x-card>

        <x-card icon="fas fa-stop" title="Cierre del centro de votación">
            <div class="flex gap-5 flex-wrap">
                @foreach ($locations as $location)
                <div
                    class="w-12 h-12 text-center bg-{{$location->cierre != null ? 'green':'gray'}}-600 text-white rounded-full flex content-center flex-wrap justify-center font-bold text-xl">
                    <div>{{$location->name}}</div>
                </div>
                @endforeach
            </div>
        </x-card>

        <x-card icon="fas fa-stopwatch-20" title="Inicio de conteo de votos">
            <div class="flex gap-5 flex-wrap">
                @foreach ($locations as $location)
                <div
                    class="w-12 h-12 text-center bg-{{$location->conteo != null ? 'green':'gray'}}-600 text-white rounded-full flex content-center flex-wrap justify-center font-bold text-xl">
                    <div>{{$location->name}}</div>
                </div>
                @endforeach
            </div>
        </x-card>
    </div>
    @elseif($view == 'attendance')
    <x-card icon="fab fa-searchengin" title="Asistencia por sede">
        <div class="relative pt-1 hover:border-gray-400 border-white border border-solid p-1 rounded">
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
                        GLOBAL
                    </span>
                </div>
                <div class="text-left">
                    <span class="text-xs font-semibold inline-block text-gray-600">
                        {{$event->guests()->whereNotNull('attendance_door_id')->count()}} de
                        72220
                    </span>
                </div>
                <div class="text-right">
                    <span class="text-xs font-semibold inline-block text-gray-600">
                        {{$event->guests()->count() > 0
                        ?round(($event->guests()->whereNotNull('attendance_door_id')->count()/$event->guests()->count())*100,0)
                        : '0'}}%


                    </span>
                </div>
            </div>
            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                <div style="width: {{$event->guests()->count() > 0 ?round(($event->guests()->whereNotNull('attendance_door_id')->count()/$event->guests()->count())*100,0) : '0'}}%"
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
        <div class="grid grid-cols-3 gap-5">
            @foreach ($locations as $location)
            <div class="relative pt-1 hover:border-gray-400 border-white border border-solid p-1 rounded">
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
                            Sede {{$location->name}}
                        </span>
                    </div>
                    <div class="text-left">
                        <span class="text-xs font-semibold inline-block text-gray-600">
                            {{$location->guests()->whereNotNull('attendance_door_id')->count()}} de
                            {{$location->boletas}}
                        </span>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-semibold inline-block text-gray-600">
                            {{$location->guests()->count() > 0
                            ?round(($location->guests()->whereNotNull('attendance_door_id')->count()/$location->boletas)*100,0)
                            : '0'}}%


                        </span>
                    </div>
                </div>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                    <div style="width: {{$location->guests()->count() > 0 ?round(($location->guests()->whereNotNull('attendance_door_id')->count()/$location->boletas)*100,0) : '0'}}%"
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
            @endforeach
        </div>
    </x-card>
    @elseif($view == 'attendance2')
    <x-card icon="fab fa-searchengin" title="Asistencia por coordinación">
        <div class="grid grid-cols-3 gap-5">
            @foreach ($coordinations as $coordination)
            <div class="relative pt-1 hover:border-gray-400 border-white border border-solid p-1 rounded">
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
                    w-40
                    text-center
                  ">
                            {{$coordination->name}}
                        </span>
                    </div>
                    <div class="text-left">
                        <span class="text-xs font-semibold inline-block text-gray-600">
                            {{$coordination->count_pending_guests()}} de
                            {{$coordination->count_guests()}}
                        </span>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-semibold inline-block text-gray-600">
                            {{$coordination->count_guests() > 0
                            ?round(($coordination->count_pending_guests()/$coordination->count_guests())*100,0)
                            : '0'}}%


                        </span>
                    </div>
                </div>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                    <div style="width: {{$coordination->count_guests() > 0 ?round(($coordination->count_pending_guests()/$coordination->count_guests())*100,0) : '0'}}%"
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
            @endforeach
        </div>
    </x-card>
    @elseif($view == 'count')
    <x-card icon="fab fa-searchengin" title="Preliminar de votaciones por sede">
        @if (Auth::user()->hasPermission('Jurídico') || Auth::user()->hasPermission('Administrator') ||
        Auth::user()->hasPermission('Jurídico Global'))

        <div class="relative pt-1 hover:border-gray-400 border-white border border-solid p-1 rounded">
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
                font-bold
                bg-{{$event->locations()->sum('si') == 0 && $event->locations()->sum('no') == 0 ? 'gray-200 text-gray-600' : ($event->locations()->sum('si') > ($event->locations()->sum('no') + $event->locations()->sum('nulos')) ? 'green-600 text-white':'red-500 text-white')}}
              ">
                        GLOBAL
                    </span>
                </div>
                <div class="text-left">
                    <span class="text-base font-bold inline-block text-gray-600">
                        Si
                        {{round(($event->locations()->sum('si')+$event->locations()->sum('no')+$event->locations()->sum('nulos'))
                        > 0 ?
                        ($event->locations()->sum('si')/($event->locations()->sum('si')+$event->locations()->sum('no')+$event->locations()->sum('nulos')))*100:0,0)
                        ?? 0}}% ({{$event->locations()->sum('si')}})
                    </span>
                </div>
                <div class="text-left">
                    <span class="text-xs font-semibold inline-block text-gray-600">
                        No
                        {{round(($event->locations()->sum('si')+$event->locations()->sum('no')+$event->locations()->sum('nulos'))
                        > 0 ?
                        ($event->locations()->sum('no')/($event->locations()->sum('si')+$event->locations()->sum('no')+$event->locations()->sum('nulos')))*100:0,0)
                        ?? 0}}% ({{$event->locations()->sum('no')}})
                    </span>
                </div>
                <div class="text-left">
                    <span class="text-xs font-semibold inline-block text-gray-600">
                        Nulo
                        {{round(($event->locations()->sum('si')+$event->locations()->sum('no')+$event->locations()->sum('nulos'))
                        > 0 ?
                        ($event->locations()->sum('nulos')/($event->locations()->sum('si')+$event->locations()->sum('no')+$event->locations()->sum('nulos')))*100:0,0)
                        ?? 0}}% ({{$event->locations()->sum('nulos')}})
                    </span>
                </div>
                <div class="text-left">
                    <span class="text-xs font-semibold inline-block text-gray-600">
                        No votó {{$event->locations()->sum('anulados')}}
                    </span>
                </div>
            </div>
            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                <div style="width: {{round(($event->locations()->sum('si')+$event->locations()->sum('no')+$event->locations()->sum('nulos')) > 0 ?
                    ($event->locations()->sum('si')/($event->locations()->sum('si')+$event->locations()->sum('no')+$event->locations()->sum('nulos')))*100:0,0) ?? 0}}%"
                    class="
              shadow-none
              flex flex-col
              text-center
              whitespace-nowrap
              text-white
              justify-center
              bg-green-500
            "></div>
                <div style="width: {{round(($event->locations()->sum('si')+$event->locations()->sum('no')+$event->locations()->sum('nulos')) > 0 ?
                    ($event->locations()->sum('no')/($event->locations()->sum('si')+$event->locations()->sum('no')+$event->locations()->sum('nulos')))*100:0,0) ?? 0}}%"
                    class="
          shadow-none
          flex flex-col
          text-center
          whitespace-nowrap
          text-white
          justify-center
          bg-red-500
        "></div>
                <div style="width: {{round(($event->locations()->sum('si')+$event->locations()->sum('no')+$event->locations()->sum('nulos')) > 0 ?
            ($event->locations()->sum('nulos')/($event->locations()->sum('si')+$event->locations()->sum('no')+$event->locations()->sum('nulos')))*100:0,0) ?? 0}}%"
                    class="
  shadow-none
  flex flex-col
  text-center
  whitespace-nowrap
  text-white
  justify-center
  bg-gray-400
"></div>
            </div>
        </div>
        @endif
        <div class="grid grid-cols-3 gap-5">
            @foreach ($locations as $location)
            <div class="relative pt-1 hover:border-gray-400 border-white border border-solid p-1 rounded">
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
                    font-bold
                    bg-{{$location->si == 0 && $location->no == 0 ? 'gray-200 text-gray-600' : ($location->si > ($location->no + $location->nulos) ? 'green-600 text-white':'red-500 text-white')}}
                  ">
                            Sede {{$location->name}}
                        </span>
                    </div>
                    <div class="text-left">
                        <span class="text-base font-bold inline-block text-gray-600">
                            Si {{round(($location->si+$location->no+$location->nulos) > 0 ?
                            ($location->si/($location->si+$location->no+$location->nulos))*100:0,0) ?? 0}}%
                        </span>
                    </div>
                    <div class="text-left">
                        <span class="text-xs font-semibold inline-block text-gray-600">
                            No {{round(($location->si+$location->no+$location->nulos) > 0 ?
                            ($location->no/($location->si+$location->no+$location->nulos))*100:0,0) ?? 0}}%
                        </span>
                    </div>
                    <div class="text-left">
                        <span class="text-xs font-semibold inline-block text-gray-600">
                            Nulo {{round(($location->si+$location->no+$location->nulos) > 0 ?
                            ($location->nulos/($location->si+$location->no+$location->nulos))*100:0,0) ?? 0}}%
                        </span>
                    </div>
                    <div class="text-left">
                        <span class="text-xs font-semibold inline-block text-gray-600">
                            No votó {{$location->anulados}}
                        </span>
                    </div>
                </div>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                    <div style="width: {{round(($location->si+$location->no+$location->nulos) > 0 ?
                        ($location->si/($location->si+$location->no+$location->nulos))*100:0,0) ?? 0}}%" class="
                  shadow-none
                  flex flex-col
                  text-center
                  whitespace-nowrap
                  text-white
                  justify-center
                  bg-green-500
                "></div>
                    <div style="width: {{round(($location->si+$location->no+$location->nulos) > 0 ?
                        ($location->no/($location->si+$location->no+$location->nulos))*100:0,0) ?? 0}}%" class="
              shadow-none
              flex flex-col
              text-center
              whitespace-nowrap
              text-white
              justify-center
              bg-red-500
            "></div>
                    <div style="width: {{round(($location->si+$location->no+$location->nulos) > 0 ?
                ($location->nulos/($location->si+$location->no+$location->nulos))*100:0,0) ?? 0}}%" class="
      shadow-none
      flex flex-col
      text-center
      whitespace-nowrap
      text-white
      justify-center
      bg-gray-400
    "></div>
                </div>
            </div>
            @endforeach
        </div>
    </x-card>
    @elseif($view == 'count2')
    <x-card icon="fab fa-searchengin" title="Preliminar de votaciones por coordinación">
        <div class="grid grid-cols-3 gap-5">
            @foreach ($coordinations as $coordination)
            <div class="relative pt-1 hover:border-gray-400 border-white border border-solid p-1 rounded">
                <div class="flex mb-2 items-center justify-between">
                    <div>
                        <span class="
                    text-xl
                    font-semibold
                    inline-block
                    py-1
                    px-2
                    uppercase
                    rounded-full
                    font-bold
                    w-64
                    text-center
                    bg-{{$coordination->doors()->sum('si') == 0 && $coordination->doors()->sum('no') == 0 ? 'gray-200 text-gray-600' : ($coordination->doors()->sum('si') > ($coordination->doors()->sum('no') + $coordination->doors()->sum('nulos')) ? 'green-600 text-white':'red-500 text-white')}}
                  ">
                            {{$coordination->name}}
                        </span>
                    </div>
                    <div class="text-left">
                        <span class="text-xl font-bold inline-block text-gray-600">
                            Si
                            {{round(($coordination->doors()->sum('si')+$coordination->doors()->sum('no')+$coordination->doors()->sum('nulos'))
                            > 0 ?
                            ($coordination->doors()->sum('si')/($coordination->doors()->sum('no')+$coordination->doors()->sum('si')+$coordination->doors()->sum('nulos')))*100:0,0)
                            ?? 0}}%
                        </span>
                    </div>
                    <div class="text-left">
                        <span class="text-xl font-semibold inline-block text-gray-600">
                            No
                            {{round(($coordination->doors()->sum('si')+$coordination->doors()->sum('no')+$coordination->doors()->sum('nulos'))
                            > 0 ?
                            ($coordination->doors()->sum('no')/($coordination->doors()->sum('si')+$coordination->doors()->sum('no')+$coordination->doors()->sum('nulos')))*100:0,0)
                            ?? 0}}%
                        </span>
                    </div>
                    <div class="text-left">
                        <span class="text-xl font-semibold inline-block text-gray-600">
                            Nulo
                            {{round(($coordination->doors()->sum('si')+$coordination->doors()->sum('no')+$coordination->doors()->sum('nulos'))
                            > 0 ?
                            ($coordination->doors()->sum('nulos')/($coordination->doors()->sum('si')+$coordination->doors()->sum('no')+$coordination->doors()->sum('nulos')))*100:0,0)
                            ?? 0}}%
                        </span>
                    </div>
                </div>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                    <div style="width: {{round(($coordination->doors()->sum('si')+$coordination->doors()->sum('no')+$coordination->doors()->sum('nulos')) > 0 ?
                        ($coordination->doors()->sum('si')/($coordination->doors()->sum('si')+$coordination->doors()->sum('no')+$coordination->doors()->sum('nulos')))*100:0,0) ?? 0}}%"
                        class="
                  shadow-none
                  flex flex-col
                  text-center
                  whitespace-nowrap
                  text-white
                  justify-center
                  bg-green-500
                "></div>
                    <div style="width: {{round(($coordination->doors()->sum('si')+$coordination->doors()->sum('no')+$coordination->doors()->sum('nulos')) > 0 ?
                        ($coordination->doors()->sum('no')/($coordination->doors()->sum('si')+$coordination->doors()->sum('no')+$coordination->doors()->sum('nulos')))*100:0,0) ?? 0}}%"
                        class="
              shadow-none
              flex flex-col
              text-center
              whitespace-nowrap
              text-white
              justify-center
              bg-red-500
            "></div>
                    <div style="width: {{round(($coordination->doors()->sum('si')+$coordination->doors()->sum('no')+$coordination->doors()->sum('nulos')) > 0 ?
                ($coordination->doors()->sum('nulos')/($coordination->doors()->sum('si')+$coordination->doors()->sum('no')+$coordination->doors()->sum('nulos')))*100:0,0) ?? 0}}%"
                        class="
      shadow-none
      flex flex-col
      text-center
      whitespace-nowrap
      text-white
      justify-center
      bg-gray-400
    "></div>
                </div>
            </div>
            @endforeach
        </div>
    </x-card>
    <x-card icon="fab fa-searchengin" title="Preliminar de votaciones por sección">
        <div class="grid grid-cols-3 gap-5">
            @foreach ($locations as $location)
            @foreach ($location->doors as $door)
            <div class="relative pt-1 hover:border-gray-400 border-white border border-solid p-1 rounded">
                <div class="flex mb-2 items-center justify-between">
                    <div>
                        <span class="
                    text-lg
                    font-semibold
                    inline-block
                    py-1
                    px-2
                    uppercase
                    rounded-full
                    font-bold
                    w-40
                    text-center
                    bg-{{$door->si == 0 && $door->no == 0 ? 'gray-200 text-gray-600' : ($door->si > ($door->no + $door->nulos) ? 'green-600 text-white':'red-500 text-white')}}
                  ">
                            Sección {{$door->name}}
                        </span>
                    </div>
                    <div class="text-left">
                        <span class="text-xl font-bold inline-block text-gray-600">
                            Si
                            {{round(($door->si+$door->no+$door->nulos)
                            > 0 ?
                            ($door->si/($door->no+$door->si+$door->nulos))*100:0,0)
                            ?? 0}}%
                        </span>
                    </div>
                    <div class="text-left">
                        <span class="text-xl font-semibold inline-block text-gray-600">
                            No
                            {{round(($door->si+$door->no+$door->nulos)
                            > 0 ?
                            ($door->no/($door->si+$door->no+$door->nulos))*100:0,0)
                            ?? 0}}%
                        </span>
                    </div>
                    <div class="text-left">
                        <span class="text-xl font-semibold inline-block text-gray-600">
                            Nulo
                            {{round(($door->si+$door->no+$door->nulos)
                            > 0 ?
                            ($door->nulos/($door->si+$door->no+$door->nulos))*100:0,0)
                            ?? 0}}%
                        </span>
                    </div>
                </div>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                    <div style="width: {{round(($door->si+$door->no+$door->nulos) > 0 ?
                        ($door->si/($door->si+$door->no+$door->nulos))*100:0,0) ?? 0}}%" class="
                  shadow-none
                  flex flex-col
                  text-center
                  whitespace-nowrap
                  text-white
                  justify-center
                  bg-green-500
                "></div>
                    <div style="width: {{round(($door->si+$door->no+$door->nulos) > 0 ?
                        ($door->no/($door->si+$door->no+$door->nulos))*100:0,0) ?? 0}}%" class="
              shadow-none
              flex flex-col
              text-center
              whitespace-nowrap
              text-white
              justify-center
              bg-red-500
            "></div>
                    <div style="width: {{round(($door->si+$door->no+$door->nulos) > 0 ?
                ($door->nulos/($door->si+$door->no+$door->nulos))*100:0,0) ?? 0}}%" class="
      shadow-none
      flex flex-col
      text-center
      whitespace-nowrap
      text-white
      justify-center
      bg-gray-400
    "></div>
                </div>
            </div>
            @endforeach
            @endforeach
        </div>
    </x-card>
    @endif

</div>