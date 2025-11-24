<div>
    <x-card title="Resumen consolidado de actas parciales" px="0" py="0">
        <x-table>
            <x-slot name="thead">
                <th class="py-3"></th>
                <th class="pr-5 py-3 text-left">Sede</th>
                <th class="px-5 py-3 text-center">Boletas</th>
                <th class="px-5 py-3 text-center">Votos EMITIDOS</th>
                <th class="px-5 py-3 text-center">Votos SI</th>
                <th class="px-5 py-3 text-center">Votos NO</th>
                <th class="px-5 py-3 text-center">Votos Validos</th>
                <th class="px-5 py-3 text-center">Votos Validos x</th>
                <th class="px-5 py-3 text-center">Votos Nulos</th>
                <th class="px-5 py-3 text-center">Boletas Inutilizadas</th>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($event->locations as $location)
                <tr class="hover:bg-gray-100">
                    <td class=" px-3">
                        @if (
                        ($location->emitidos - $location->juridico_emitidos) != 0
                        || ($location->si - $location->juridico_si) != 0
                        || ($location->no - $location->juridico_no) != 0
                        || ($location->validos - $location->juridico_validos) != 0
                        || ($location->nulos - $location->juridico_nulos) != 0
                        || ($location->anulados - $location->juridico_anulados) != 0
                        )
                        <i class="fas fa-times text-red-600 text-lg"></i>
                        @else
                        <i class="fas fa-check text-green-600 text-lg"></i>
                        @endif
                    </td>
                    <td class="pr-5 py-3 text-left">{{$location->name}}</td>
                    <td class="px-5 py-3 text-center">{{$location->boletas}}</td>
                    <td
                        class="px-5 py-3 text-center {{($location->emitidos - $location->juridico_emitidos) == 0 ? 'text-green-600':'text-red-600'}}">
                        {{$location->emitidos}} / {{$location->juridico_emitidos}}</td>
                    <td
                        class="px-5 py-3 text-center {{($location->si - $location->juridico_si) == 0 ? 'text-green-600':'text-red-600'}}">
                        {{$location->si}} / {{$location->juridico_si}}</td>
                    <td
                        class="px-5 py-3 text-center {{($location->no - $location->juridico_no) == 0 ? 'text-green-600':'text-red-600'}}">
                        {{$location->no}} / {{$location->juridico_no}}</td>
                    <td
                        class="px-5 py-3 text-center {{($location->validos - $location->juridico_validos) == 0 ? 'text-green-600':'text-red-600'}}">
                        {{$location->validos}} / {{$location->juridico_validos}}</td>
                    <td
                        class="px-5 py-3 text-center {{($location->validos - $location->juridico_validos) == 0 ? 'text-green-600':'text-red-600'}}">
                        {{($location->juridico_si + $location->juridico_no) - $location->juridico_validos}}</td>
                    <td
                        class="px-5 py-3 text-center {{($location->nulos - $location->juridico_nulos) == 0 ? 'text-green-600':'text-red-600'}}">
                        {{$location->nulos}} / {{$location->juridico_nulos}}</td>
                    <td
                        class="px-5 py-3 text-center {{($location->anulados - $location->juridico_anulados) == 0 ? 'text-green-600':'text-red-600'}}">
                        {{$location->anulados}} / {{$location->juridico_anulados}}</td>
                </tr>
                @endforeach
            </x-slot>
        </x-table>

    </x-card>

    <x-card title="Resultado final" px="0" py="0">
        <x-table>
            <x-slot name="thead">
                <th class="py-3"></th>
                <th class="pr-5 py-3 text-center">Boletas</th>
                <th class="px-5 py-3 text-center">con DERECHO A VOTO</th>
                <th class="px-5 py-3 text-center">Votos EMITIDOS</th>
                <th class="px-5 py-3 text-center">Votos SI</th>
                <th class="px-5 py-3 text-center">Votos NO</th>
                <th class="px-5 py-3 text-center">Votos Validos</th>
                <th class="px-5 py-3 text-center">Votos Validos x</th>
                <th class="px-5 py-3 text-center">Votos Nulos</th>
                <th class="px-5 py-3 text-center">Boletas Anuladas</th>
            </x-slot>
            <x-slot name="tbody">
                <tr class="hover:bg-gray-100">
                    <td class=" px-3">
                        @if (
                        ($event->locations()->sum('si') - $event->locations()->sum('juridico_si')) != 0
                        || ($event->locations()->sum('emitidos') - $event->locations()->sum('juridico_emitidos')) != 0
                        || ($event->locations()->sum('no') - $event->locations()->sum('juridico_no')) != 0
                        || ($event->locations()->sum('validos') - $event->locations()->sum('juridico_validos')) != 0
                        || ($event->locations()->sum('nulos') - $event->locations()->sum('juridico_nulos')) != 0
                        || ($event->locations()->sum('anulados') - $event->locations()->sum('juridico_anulados')) != 0
                        )
                        <i class="fas fa-times text-red-600 text-lg"></i>
                        @else
                        <i class="fas fa-check text-green-600 text-lg"></i>
                        @endif
                    </td>
                    <td class="pr-5 py-3 text-center">{{$event->locations()->sum('boletas')}}</td>
                    <td class="pr-5 py-3 text-center">{{$event->locations()->sum('juridico_derecho')}}</td>
                    <td
                        class="px-5 py-3 text-center {{($event->locations()->sum('emitidos') - $event->locations()->sum('juridico_emitidos')) == 0 ? 'text-green-600':'text-red-600'}}">
                        {{$event->locations()->sum('emitidos')}} / {{$event->locations()->sum('juridico_emitidos')}}
                    </td>
                    <td
                        class="px-5 py-3 text-center {{($event->locations()->sum('si') - $event->locations()->sum('juridico_si')) == 0 ? 'text-green-600':'text-red-600'}}">
                        {{$event->locations()->sum('si')}} / {{$event->locations()->sum('juridico_si')}}</td>
                    <td
                        class="px-5 py-3 text-center {{($event->locations()->sum('no') - $event->locations()->sum('juridico_no')) == 0 ? 'text-green-600':'text-red-600'}}">
                        {{$event->locations()->sum('no')}} / {{$event->locations()->sum('juridico_no')}}</td>
                    <td
                        class="px-5 py-3 text-center {{($event->locations()->sum('validos') - $event->locations()->sum('juridico_validos')) == 0 ? 'text-green-600':'text-red-600'}}">
                        {{$event->locations()->sum('validos')}} / {{$event->locations()->sum('juridico_validos')}}</td>
                    <td
                        class="px-5 py-3 text-center {{($event->locations()->sum('validos') - $event->locations()->sum('juridico_validos')) == 0 ? 'text-green-600':'text-red-600'}}">
                        {{$event->locations()->sum('si')+$event->locations()->sum('no')}}</td>
                    <td
                        class="px-5 py-3 text-center {{($event->locations()->sum('nulos') - $event->locations()->sum('juridico_nulos')) == 0 ? 'text-green-600':'text-red-600'}}">
                        {{$event->locations()->sum('nulos')}} / {{$event->locations()->sum('juridico_nulos')}}</td>
                    <td
                        class="px-5 py-3 text-center {{($event->locations()->sum('anulados') - $event->locations()->sum('juridico_anulados')) == 0 ? 'text-green-600':'text-red-600'}}">
                        {{$event->locations()->sum('anulados')}} / {{$event->locations()->sum('juridico_anulados')}}
                    </td>
                </tr>
            </x-slot>
        </x-table>

    </x-card>
</div>