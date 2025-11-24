<div>
    @if ($view == 'show')
    <div class="grid grid-cols-4 gap-5">
        <div class="col-span-3">
            <div class="grid grid-cols-4 gap-5">
                <div class="col-span-3"></div>
                <div>
                    <x-search></x-search>
                </div>
            </div>
            <x-table>
                <x-slot name="thead">
                    <th class="py-3 px-6 text-left">Clave de empleado</th>
                    <th class="py-3 px-6 text-left">Nombre</th>
                    <th class="py-3 px-6 text-left">Sede</th>
                    <th class="py-3 px-6 text-left">Puerta</th>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($user_list as $user)
                    <tr>
                        <td class="py-3 px-6 text-left whitespace-nowrap flex">
                            <img src="{{Storage::url($user->profile_photo_path);}}"
                                class="rounded-full h-12 w-12 object-cover">
                            <span class="ml-2 pt-3">{{$user->username}}</span>
                        </td>
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{$user->name}}</td>
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            {{$user->location()->name}}</td>
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            {{$user->door()->name}}</td>
                    </tr>
                    @endforeach
                </x-slot>
                <x-slot name="pagination">
                    {{$user_list->links()}}
                </x-slot>
            </x-table>
        </div>
        <x-card title="Actualizar padrón" icon="fas fa-user-edit">
            <input id="csv_file" type="file" accept=".csv" class="form-control" name="csv_file" wire:model="users"
                required>
            <x-jet-input-error for="users"></x-jet-input-error>
            <x-slot name="footer">
                <x-button class="w-full" color="blue" icon="fas fa-user-edit" click="update"
                    wire:loading.attr="disabled" wire:target="users">Actualizar padrón
                </x-button>
            </x-slot>
        </x-card>
    </div>
    @else
    <x-table>
        <x-slot name="thead">
            <th class="py-3 px-6 text-left">Clave de empleado</th>
            <th class="py-3 px-6 text-left">Nombre</th>
            <th class="py-3 px-6 text-left">Sede</th>
            <th class="py-3 px-6 text-left">Puerta</th>
        </x-slot>
        <x-slot name="tbody">
            @foreach ($users_data as $user)
            @if ($user['new'] === true)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="text-green-600 py-3 px-6 text-left whitespace-nowrap">{{$user['username']}}</td>
                <td class="text-green-600 py-3 px-6 text-left whitespace-nowrap">{{$user['name']}}</td>
                <td class="py-3 px-6 text-left {{$user['new_sede'] == true ? '': 'text-green-600'}}">
                    {{$user['sede']}}
                </td>
                <td class="py-3 px-6 text-left {{$user['new_door'] == true ? '': 'text-green-600'}}">
                    {{$user['door']}}
                </td>
            </tr>
            @else
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">{{$user['username']}}</td>
                <td class="py-3 px-6 text-left {{$user['name'] == $user['db']['name'] ? '': 'text-green-600'}}">
                    {!!$user['name'] == $user['db']['name'] ? '': '<span class="text-gray-500
                        line-through">'.$user['db']['name'].'</span><br />'!!}
                    {{$user['name'] == $user['db']['name'] ? $user['db']['name']: $user['name']}}</td>
                <td class="py-3 px-6 text-left {{$user['new_sede'] == true ? '': 'text-green-600'}}">
                    {{$user['sede']}}
                </td>
                <td class="py-3 px-6 text-left {{$user['new_door'] == true ? '': 'text-green-600'}}">
                    {{$user['door']}}
                </td>
            </tr>
            @endif
            @endforeach
        </x-slot>
    </x-table>

    <x-button color="blue" icon="fas fa-user-edit" click="save">
        Actualizar padrón
    </x-button>
    @endif

</div>