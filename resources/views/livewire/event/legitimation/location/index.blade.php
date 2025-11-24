<x-card title="Sedes del evento" px="0" py="0">
    <x-table>
        <x-slot name="thead">
            <th class="text-left px-5 py-3">Nombre</th>
            <th class="text-left px-5 py-3"># de invitados</th>
            <th class="text-left px-5 py-3"># de Boletas</th>
            <th class="text-left px-5 py-3">Hora</th>
            <th class="text-left px-5 py-3">Georeferencias</th>
            <th class="text-left px-5 py-3">Convocatoria</th>
        </x-slot>
        <x-slot name="tbody">
            @foreach ($locations as $key => $location)
            <tr class="hover:bg-gray-100">
                <td class="px-5 py-3">
                    <x-a
                        :href="route('legitimation.locations.location',['event' => $event->id,'location'=>$location->id])">
                        {{$location->name}}</x-a>
                </td>
                <td class="px-5 py-3">{{$location->guests()->count()}}</td>
                <td class="px-5 py-3">{{$location->boletas}}</td>
                <td class="px-5 py-3">{{$location->schedule}}</td>
                <td class="px-5 py-3">{{$location->georeferences != NULL ? 'SI':'NO'}}</td>
                <td class="px-5 py-3">{{$location->convocatoria != NULL ? 'SI':'NO'}}</td>
            </tr>
            @endforeach
        </x-slot>
    </x-table>
</x-card>