<x-table>
    <x-slot name="thead">
        <th class="text-left p-3">Sede</th>
        <th class="text-left p-3">Boletas</th>
        <th class="text-left p-3">con derecho a voto</th>
        <th class="text-left p-3">Voto emitidos</th>
        <th class="text-left p-3">Voto si</th>
        <th class="text-left p-3">Voto no</th>
        <th class="text-left p-3">Votos validos</th>
        <th class="text-left p-3">Voto nulo</th>
        <th class="text-left p-3">Boletas inutilizadas</th>
    </x-slot>
    <x-slot name="tbody">
        @foreach ($event->locations()->orderBy(DB::raw('ABS(name)'), 'ASC')->get() as $location)
        <tr>
            <td class="p-3">
                <x-a
                    :href="route('legitimation.votting.locationjuridico',['event' => $event->id, 'location' => $location->id])">
                    {{$location->name}}</x-a>
            </td>
            <td class="p-3">{{$location->boletas}}</td>
            <td class="p-3">{{$location->guests()->count()}}</td>
            <td class=" p-3">{{($location->juridico_derecho)}}</td>
            <td class=" p-3">{{($location->juridico_emitidos)}}</td>
            <td class=" p-3">{{($location->juridico_si)}}</td>
            <td class=" p-3">{{($location->juridico_no)}}</td>
            <td class=" p-3">{{($location->juridico_validos)}}</td>
            <td class=" p-3">{{($location->juridico_nulos)}}</td>
            <td class=" p-3">{{($location->juridico_anulados)}}</td>
        </tr>
        @endforeach
    </x-slot>
</x-table>
<x-button icon="fas fa-not-equal" color="blue" :href="route('legitimation.votting.consolidate',['event' => $event->id])"
    class="mt-5">Consolidar padrón</x-button>