<div>
    <x-card icon="fas fa-print" title="Expediente general" px="0" py="0">
        <x-table>
            <x-slot name="thead">
                <th class="pl-5 py-3 w-8"></th>
                <th class="px-5 py-3 text-left">Documento</th>
                <th class="pr-5 py-3 w-8"></th>
            </x-slot>
            <x-slot name="tbody">
                @if (count($event->globalArchives()) == 0)
                <tr>
                    <td colspan="3" class="text-center text-red-500 font-bold py-3">No se a subido ningún
                        documento aún.
                    </td>
                </tr>
                @endif
                @foreach ($event->globalArchives() as $archive)
                <tr>
                    <td class="pl-5 py-3">
                        <x-a color="red" href="{{Storage::url($archive->path)}}" download="true"><i
                                class="fas fa-download"></i></x-a>
                    </td>
                    <td class="px-5 py-3">
                        <x-a color="gray" href="{{Storage::url($archive->path)}}" download="true">{{$archive->name}}
                        </x-a>
                    </td>
                    <td class="px-5 py-3">
                        @if (Auth::user()->hasPermission('Jurídico') || Auth::user()->hasPermission('Administrator'))
                        <i class="fas fa-trash text-red-500 hover:text-red-600 cursor-pointer"
                            wire:click="delete({{$archive->id}})"></i>
                        @endif
                    </td>
                </tr>
                @endforeach
            </x-slot>
        </x-table>
        @if (Auth::user()->hasPermission('Jurídico') || Auth::user()->hasPermission('Administrator'))
        <x-slot name="footer">
            <x-button :href="route('legitimation.archive.upload',['event' => $event, 'location' => 'global'])"
                color="blue" icon="fas fa-file-upload">Agregar documento</x-button>
        </x-slot>
        @endif
    </x-card>
    @foreach ($locations as $location)
    <x-card icon="fas fa-print" title="Expediente de la sede {{$location->name}}" px="0" py="0">
        <x-table>
            <x-slot name="thead">
                <th class="pl-5 py-3 w-8"></th>
                <th class="px-5 py-3 text-left">Documento</th>
                <th class="pr-5 py-3 w-8"></th>
            </x-slot>
            <x-slot name="tbody">
                @if (count($location->archives) == 0)
                <tr>
                    <td colspan="3" class="text-center text-red-500 font-bold py-3">No se a subido ningún
                        documento aún.
                    </td>
                </tr>
                @endif
                @foreach ($location->archives()->orderBy('name')->get() as $archive)
                <tr>
                    <td class="pl-5 py-3">
                        <x-a color="red" href="{{Storage::url($archive->path)}}" download="true"><i
                                class="fas fa-download"></i></x-a>
                    </td>
                    <td class="px-5 py-3">
                        <x-a color="gray" href="{{Storage::url($archive->path)}}" download="true">{{$archive->name}}
                        </x-a>
                    </td>
                    <td class="px-5 py-3">
                        <i class="fas fa-trash text-red-500 hover:text-red-600 cursor-pointer"
                            wire:click="delete({{$archive->id}})"></i>
                    </td>
                </tr>
                @endforeach
            </x-slot>
        </x-table>
        @if (Auth::user()->hasPermission('Jurídico') || Auth::user()->hasPermission('Administrator'))
        <x-slot name="footer">
            <x-button :href="route('legitimation.archive.upload',compact('event','location'))" color="blue"
                icon="fas fa-file-upload">Agregar documento</x-button>
        </x-slot>
        @endif
    </x-card>
    @endforeach

</div>