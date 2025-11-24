<x-table>
    <x-slot name="thead">
        <th class="text-left p-3">Sede</th>
        <th class="w-48"></th>
    </x-slot>
    <x-slot name="tbody">
        @foreach ($user_locations as $location)
        @foreach ($location->doors as $door)
        <tr class="hover:bg-gray-100">
            <td class="p-3">
                {{$location->name}} Sección {{$door->name}}
            </td>
            <td class="text-center p-3">
                <x-button href="{{route('legitimation.tester',['location' => $location->id, 'door' => $door->id])}}">
                    Descargar cédulas</x-button>
            </td>
        </tr>
        @endforeach
        @endforeach
    </x-slot>
</x-table>