<x-table>
    <x-slot name="thead">
        <th class="px-3 py-3 text-left">Sección</th>
        <th class="px-3 py-3"></th>
    </x-slot>
    <x-slot name="tbody">
        @foreach ($event->locations as $location)
        @foreach ($location->doors as $door)
        <tr>
            <td class="px-3 py-3">{{$door->name}}</td>
            <td>
                <select wire:change="setCoordination({{$door->id}},$event.target.value)">
                    <option value="">Elige una opción</option>
                    @foreach ($coordinations as $coordination)
                    <option value="{{$coordination->id}}" {{$door->coordination_id == $coordination->id ? 'selected' :
                        ''}}>{{$coordination->name}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        @endforeach
        @endforeach
    </x-slot>
</x-table>