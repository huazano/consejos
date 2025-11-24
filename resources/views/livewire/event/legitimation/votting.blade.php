<x-table>
    <x-slot name="thead">
        <th class="text-left p-3">Sede</th>
        <th class="text-left p-3">Boletas</th>
        <th class="text-left p-3">Con derecho a voto</th>
        <th class="text-left p-3">Votos emitidos</th>
        <th class="text-left p-3">Votos si</th>
        <th class="text-left p-3">Votos no</th>
        <th class="text-left p-3">Votos Validos</th>
        <th class="text-left p-3">Voto nulo</th>
        <th class="text-left p-3">Boletas inutilizadas</th>
    </x-slot>
    <x-slot name="tbody">
        @foreach ($user_locations as $location)
        <tr>
            <td class="p-3">
                <x-a
                    :href="route('legitimation.votting.location',['event' => $event->id, 'location' => $location->id])">
                    {{$location->name}}</x-a>
            </td>
            <td class="p-3">{{$location->boletas}}</td>
            <td class=" p-3">{{($location->guests()->count())}}</td>
            <td class=" p-3">{{($location->emitidos)}}</td>
            <td class=" p-3">{{($location->si)}}</td>
            <td class=" p-3">{{($location->no)}}</td>
            <td class=" p-3">{{($location->validos)}}</td>
            <td class=" p-3">{{($location->nulos)}}</td>
            <td class=" p-3">{{($location->anulados)}}</td>
        </tr>
        @endforeach
    </x-slot>
</x-table>