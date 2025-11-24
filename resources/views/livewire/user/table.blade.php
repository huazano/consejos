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
                <td class="w-16"></td>
                <th class="text-left px-3 py-2">{{__('User')}}</th>
                <th class="text-left px-3 py-2">{{__('Name')}}</th>
                <th class="text-left px-3 py-2">{{__('Email')}}</th>
                <th class="text-left px-3 py-2">{{__('Permission')}}</th>
            </x-slot>
            <x-slot name="tbody">
                @if (count($users) == 0)
                <tr>
                    <td colspan="4" class="text-center font-bold text-lg p-2 text-red-600">
                        {{__('No record was found.')}}
                    </td>
                </tr>
                @else

                @foreach ($users as $user)
                <tr>
                    <td>
                        @if($user->profile_photo_path)
                        <a href="{{route('users.edit',['id' => $user->id])}}"
                            class="text-red-600 font-bold hover:text-red-800">
                            <img src="{{Storage::url($user->profile_photo_path)}}" class="rounded-full p-1 w-16 h-16">
                        </a>
                        @endif
                    </td>
                    <td class="text-left px-3 pr-2">
                        <a href="{{route('users.edit',['id' => $user->id])}}"
                            class="text-red-600 font-bold hover:text-red-800">{{$user->username}}</a>
                    </td>
                    <td class="text-left px-3 py-2">{{$user->name}}</td>
                    <td class="text-left px-3 py-2">{{$user->email}}</td>
                    <td class="text-left px-3 py-2">
                        {{$user->permission ? __($user->permission->name) : __('Without permits')}}
                    </td>
                </tr>
                @endforeach
                @endif
            </x-slot>

            <x-slot name="pagination">
                {{$users->links()}}
            </x-slot>
        </x-table>

    </div>
    <div wire:loading.delay wire:loading.inline wire:target="search">
        <x-loading-table rows="15" columns="4"></x-loading-table>
    </div>
</div>