<div>
    <x-card icon="fas fa-user" :title="__('Edit user data')">
        <div class="grid grid-cols-12">
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">{{__('Photography')}}</p>
                <p class="text-sm">
                    {{__("The photo of the user, it is recommended to enter a real photo.")}}
                </p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <div class="py-3 center mx-auto">
                    <div class="bg-white px-4 py-5 rounded-lg text-center w-48">
                        <div class="mb-4">
                            @if ($profile_photo)
                            <img src="{{ $profile_photo->temporaryUrl() }}" class="w-36 h-36 rounded-full">
                            @else
                            <img src="{{Storage::url($user->profile_photo_path)}}" class="w-36 h-36 rounded-full">
                            @endif
                        </div>
                        <label class="cursor-pointer mt-6 mb-5">
                            <span
                                class="mt-2 text-base leading-normal px-4 py-2 bg-blue-500 text-white text-sm rounded-full">
                                {{__('Change photo')}}
                            </span>
                            <input type='file' class="hidden" accept="image/*" wire:model="profile_photo" />
                        </label>
                        <x-jet-input-error for="profile_photo" class="mt-5"></x-jet-input-error>
                    </div>
                </div>
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">{{__('Username')}}</p>
                <p class="text-sm">{{__('The username or nickname is used to log in.')}}</p>
            </div>
            <div class="col-span-8 pl-4 pt-2">
                <x-input type="text" :label="__('Username')" model="user.username"></x-input>
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">{{__('Name')}}</p>
                <p class="text-sm">{{__("The user's real name.")}}</p>
            </div>
            <div class="col-span-8 pl-4 pt-2">
                <x-input type="text" :label="__('Name')" model="user.name"></x-input>
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">{{__('Email')}}</p>
                <p class="text-sm">{{__("The user's email address.")}}</p>
            </div>
            <div class="col-span-8 pl-4 pt-2">
                <x-input type="email" :label="__('Email')" model="user.email"></x-input>
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">{{__('Permissions')}}</p>
                <p class="text-sm">
                    {{__("Permissions give you access to different parts of the website, choose the appropriate permission for the user.")}}
                </p>
            </div>
            <div class="col-span-8 pl-4 pt-2 mb-5">
                <div class="flex flex-col">
                    @foreach ($permissions as $permission)
                    <x-radio name="user.permission_id" value="{{$permission->id}}" model='user.permission_id'>
                        {{__($permission->name)}}</x-radio>
                    <p class="text-sm ml-7">
                        {{__($permission->description)}}
                    </p>
                    @endforeach
                </div>
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">{{__('Reset password')}}</p>
                <p class="text-sm">
                    {{__("Resetting the password will generate a new password that you will have to give to the user.")}}
                    {{__("When the user logs in with their new password, the system will ask them to change it to a personal password.")}}
                </p>
            </div>
            <div class="col-span-8 pl-4 pt-2">
                <x-button color="red" icon="fas fa-redo" click="reset_password">{{__('Reset password')}}</x-button>
            </div>
        </div>
        <x-slot name="footer">
            <x-button color="blue" icon="fas fa-save" click="save">{{__('Save changes')}}</x-button>
        </x-slot>
    </x-card>
</div>