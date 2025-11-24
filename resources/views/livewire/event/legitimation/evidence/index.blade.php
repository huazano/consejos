<div>

    <div class="grid grid-cols-2">
        <div>
            @if (Auth::user()->hasPermission('Jurídico') || Auth::user()->hasPermission('Administrator'))
            <x-button class="mb-5" color="yellow" icon="fas fa-plus"
                :href="route('legitimation.evidence.required',['event' => $event->id, 'location' => 'global'])">
                Solicitar nueva evidencia a todos</x-button>
            @endif
        </div>
        <x-search></x-search>
    </div>
    @foreach ($locations as $location)
    <x-card title="Evidencias de la sede {{$location->name}}" px="0" py="0">
        <div class="w-full overflow-x-auto">
            <x-table>
                <x-slot name="thead">
                    <th></th>
                    <th class="pr-5 py-3 text-left">Nombre de la evidencia</th>
                    <th class="px-5 py-3 text-left">Tipo de evidencia</th>
                    <th class="px-5 py-3 text-left">Ejemplo</th>
                    <th class="px-5 py-3 text-left">Fecha requerida</th>
                    <th class="px-5 py-3 text-left">Fecha subida</th>
                    <th class="px-5 py-3 text-left">Estado</th>
                    <th class="px-5 py-3 text-left">Enviada a CFCRL</th>
                    @if (Auth::user()->hasPermission('Jurídico') || Auth::user()->hasPermission('Administrator'))
                    <th class="px-5 py-3 text-left"></th>
                    @endif
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($location->evidences()->where('status', '!=', 'eliminada')->orderBy('limit_date')->get()
                    as $evidence)
                    <tr class="hover:bg-gray-100 text-base">
                        <td class="pl-5">
                            @if ($evidence->status == 'pendiente' || $evidence->status == "rechazada" ||
                            $evidence->status
                            ==
                            "en
                            revisión")
                            <div
                                class="rounded-full bg-{{$evidence->limit_date->isToday()?'yellow':($evidence->limit_date->isPast() ? 'red':'green')}}-500 w-2 h-2">
                            </div>
                            @endif
                        </td>
                        <td class="pr-5 py-2">
                            <x-a color="gray"
                                :href="route('legitimation.evidence.edit',['event' => $event->id, 'evidence' => $evidence->id])">
                                {{$evidence->name}}</x-a>
                        </td>
                        <td class="px-5 py-2">{{$evidence->evidencetype->name}}</td>
                        <td class="px-5 py-2">
                            <x-a href="{{$evidence->getExampleUrl()}}" target="_blank">Ver</x-a>
                        </td>
                        <td class="px-5 py-2">
                            {{$evidence->limit_date !== null ? $evidence->limit_date->format('d/m/Y') : null}}
                        </td>
                        <td class="px-5 py-2">
                            {{$evidence->uploaded_date !== null ? $evidence->uploaded_date->format('d/m/Y') : null}}
                        </td>
                        <td class="px-5 py-2">
                            {{$evidence->status}}
                        </td>
                        <td class="px-5 py-2">
                            {{$evidence->sended}}
                        </td>
                        @if (Auth::user()->hasPermission('Jurídico') || Auth::user()->hasPermission('Administrator'))
                        <td class="px-5 py-2">
                            <i class="fas fa-trash text-red-600 cursor-pointer hover:text-red-800"
                                wire:click="delete({{$evidence->id}})"></i>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </x-slot>
            </x-table>
            <x-slot name="footer">
                <div class="flex gap-3 justify-between">
                    <div>
                        <x-button color="blue" icon="fas fa-plus"
                            :href="route('legitimation.evidence.upload',['event' => $event->id, 'location' => $location->id])">
                            Añadir otra evidencia</x-button>
                    </div>

                    @if (Auth::user()->hasPermission('Jurídico') || Auth::user()->hasPermission('Administrator'))
                    <x-button color="yellow" icon="fas fa-plus"
                        :href="route('legitimation.evidence.required',['event' => $event->id, 'location' => $location->id])">
                        Solicitar nueva evidencia</x-button>
                    @endif
                </div>
            </x-slot>
        </div>
    </x-card>
    @endforeach
</div>