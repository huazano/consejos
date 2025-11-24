<x-table>
    <x-slot name="thead">
        <th class="text-left p-3">Sede</th>
        <th class="text-center p-3">Votos si</th>
        <th class="text-center p-3">Votos no</th>
        <th class="text-center p-3">Voto nulo</th>
        <th></th>
    </x-slot>
    <x-slot name="tbody">
        @foreach ($user_locations as $location)
        @foreach ($location->doors as $door)
        <tr>
            <td class="p-3">
                <x-a
                    :href="route('legitimation.votting.locationseccion',['event' => $event->id, 'location' => $location->id, 'door' => $door->id])">
                    {{$location->name}} Sección {{$door->name}}</x-a>
            </td>
            <td class="text-center p-3">{{($door->si ?? 0)}}</td>
            <td class="text-center p-3">{{($door->no ?? 0)}}</td>
            <td class="text-center p-3">{{($door->nulos ?? 0)}}</td>
        </tr>
        @endforeach
        @endforeach
    </x-slot>
</x-table>