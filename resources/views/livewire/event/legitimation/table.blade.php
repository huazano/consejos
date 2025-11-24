<div>
    <div>
        <div class="grid grid-cols-12 grid-gap-5 mb-5">
            <div class="col-span-9"></div>
            <div class="col-span-3">
                <x-search></x-search>
            </div>
        </div>
        <div wire:loading.remove wire:target="search">
            <x-table>
                <x-slot name="thead">
                    <th class="text-left px-3 py-2">{{__('Legitimación')}}</th>
                    <th class="text-left px-3 py-2 w-44">{{__('Fecha de inicio')}}</th>
                    <th class="text-left px-3 py-2 w-44">{{__('Fecha de cierre')}}</th>
                    <th class="w-4"></th>
                </x-slot>
                <x-slot name="tbody">
                    @if (count($legitimations) == 0)
                    <tr>
                        <td colspan="4" class="text-center font-bold text-lg p-2 text-red-600">
                            {{__('No record was found.')}}
                        </td>
                    </tr>
                    @else

                    @foreach ($legitimations as $legitimation)
                    <tr>
                        <td class="text-left p-3">
                            <i
                                class="fas fa-lock{{$legitimation->status == 'open'? '-open':''}} text-yellow-500 mr-2"></i>
                            <a href="{{route('legitimation.show',['event' => $legitimation->id])}}"
                                class="text-red-600 font-bold hover:text-red-800">

                                {{$legitimation->name}}
                            </a>
                        </td>
                        <td class="text-left p-3">
                            {{$legitimation->start_date->format('d/m/Y')}}
                        </td>
                        <td class="text-left p-3">
                            {{$legitimation->end_date->format('d/m/Y')}}
                        </td>

                        <td class="text-left p-3">
                            @if (Auth::user()->hasPermission('Administrator'))
                            <i class="fas fa-trash text-red-600 hover:text-red-700 cursor-pointer"
                                wire:click="delete({{$legitimation->id}})"></i>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </x-slot>

                <x-slot name="pagination">
                    {{$legitimations->links()}}
                </x-slot>
            </x-table>

        </div>
        <div wire:loading.delay wire:loading.inline wire:target="search">
            <x-loading-table rows="10" columns="3"></x-loading-table>
        </div>
    </div>
    @if (Auth::user()->hasPermission('Administrator'))
    <x-button icon="fas fa-plus" class="mt-5" color="green" :href="route('legitimation.create')">Crear nueva
        legitimación</x-button>
    @endif
</div>