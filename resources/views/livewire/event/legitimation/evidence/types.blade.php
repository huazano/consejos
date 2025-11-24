<div>
    <x-search></x-search>
    <x-card title="Tipos de evidencia" px="0" py="0">
        <x-table>
            <x-slot name="thead">
                <th class="px-5 py-3 text-left">Nombre</th>
                <th class="px-5 py-3 text-left">Descripción</th>
                <th class="w-12 px-5 py-3">Ejemplo</th>
            </x-slot>
            <x-slot name="tbody">
                @if (count($evidences) == 0)
                <tr>
                    <td colspan="3" class="text-center font-bold text-red-500 py-3">
                        No hay ningún tipo de evidencia aún.
                    </td>
                </tr>
                @endif
                @foreach ($evidences as $evidence)
                <tr class="hover:bg-gray-100">
                    <td class="px-5 py-3">
                        <x-a :href="route('legitimation.evidence.types.edit',['evidence' => $evidence->id])">
                            {{$evidence->name}}
                        </x-a>
                    </td>
                    <td class="px-5 py-3">{{$evidence->description}}</td>
                    <td class="px-5 py-3 text-center">
                        <x-a href="{{Storage::url($evidence->path)}}" download="true"><i class="fas fa-download"></i>
                        </x-a>
                    </td>
                </tr>
                @endforeach
            </x-slot>
            <x-slot name="paginate">
                {{$evidences->links()}}
            </x-slot>
        </x-table>
        <x-slot name="footer">
            <x-button color="blue" icon="fas fa-plus" :href="route('legitimation.evidence.types.create')">Agregar tipo
                de evidencia</x-button>
        </x-slot>
    </x-card>
</div>