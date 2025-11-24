<div>
    <x-card>
        <div class="grid grid-cols-12">
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">{{__('Convocatoria')}}</p>
                <p class="text-sm">
                    {{__("Elige el archivo de la convocatoria de la sede.")}}
                </p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <div class="py-3 center mx-auto">
                    <div class="bg-white px-4 py-5 rounded-lg text-center w-72">
                        <label class="cursor-pointer mt-6 mb-5">
                            <span
                                class="mt-2 text-base leading-normal px-4 py-2 bg-blue-500 text-white text-sm rounded-full">
                                {{__('Elegir convocatoria')}}
                            </span>
                            <input type='file' class="hidden" wire:model="convocatoria" />
                        </label>
                        <x-jet-input-error for="convocatoria" class="mt-5"></x-jet-input-error>
                    </div>
                    @if ($convocatoria)
                    <div class="text-left w-full mt-5">
                        {{$convocatoria->getClientOriginalName()}}
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">{{__('# Boletas')}}</p>
                <p class="text-sm">
                    {{__("Elige la cantidad de boletas entregadas en la sede.")}}
                </p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <x-input type="numeric" model="location.boletas"></x-input>
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">{{__('Dirección')}}</p>
                <p class="text-sm">
                    {{__("Es la dirección donde se realizara la la votación.")}}
                </p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <x-input type="numeric" model="location.description"></x-input>
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">{{__('Ubicación GPS')}}</p>
                <p class="text-sm">
                    {{__("Es la liga de la ubicación GPS.")}}
                </p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <x-input type="numeric" model="location.georeferences"></x-input>
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">{{__('Horario')}}</p>
                <p class="text-sm">
                    {{__("Es el horario en el que se realizará la votación (8:00 a 18:00 hrs).")}}
                </p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <x-input type="numeric" model="location.schedule"></x-input>
            </div>

            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">{{__('Gestores de la sede')}}</p>
                <p class="text-sm">
                    {{__("Es la lista de personas que pueden interactuar con la sede")}}
                </p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <x-input type="numeric" model="location.schedule" label="Usuario" model="user"></x-input>
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        @foreach ($search as $user)
                        <div class="flex justify-between py-3 px-3 hover:bg-gray-100">

                            <div class="flex">
                                <img src="{{Storage::url($user->profile_photo_path)}}" class="w-12 h-12">
                                <div class="grid grid-cols-1 px-3">
                                    <span>{{strtoupper($user->name)}}</span>
                                    <div>
                                        <span
                                            class="bg-blue-600 font-bold text-white px-1 rounded text-sm">{{$user->permission->name
                                            ??
                                            'Sin
                                            permisos'}}</span>
                                    </div>
                                </div>
                            </div>
                            <span class="pt-3"><i
                                    class="fa fa-arrow-right text-gray-600 hover:text-gray-900 cursor-pointer"
                                    wire:click="add_user({{$user->id}})"></i></span>
                        </div>
                        @endforeach
                    </div>
                    <div>
                        @foreach ($users as $user)
                        <div class="flex justify-between py-3 px-3 hover:bg-gray-100">

                            <div class="flex">
                                <img src="{{Storage::url($user->profile_photo_path)}}" class="w-12 h-12">
                                <div class="grid grid-cols-1 px-3">
                                    <span>{{strtoupper($user->name)}}</span>
                                    <div>
                                        <span
                                            class="bg-blue-600 font-bold text-white px-1 rounded text-sm">{{$user->permission->name
                                            ??
                                            'Sin
                                            permisos'}}</span>
                                    </div>
                                </div>
                            </div>
                            <span class="pt-3"><i class="fa fa-times text-gray-600 hover:text-red-600 cursor-pointer"
                                    wire:click="remove_user({{$user->id}})"></i></span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <x-slot name="footer">
            <div wire:loading wire:target="convocatoria">
                Espera un momento, estamos subiendo el documento.
            </div>
            @if ($convocatoria)
            <div wire:loading.remove wire:target="convocatoria">
                <x-button icon="fas fa-save" color="blue" click="save">Guardar cambios</x-button>
            </div>
            @else
            <div wire:loading.remove wire:target="convocatoria">
                <x-button icon="fas fa-save" color="blue" click="save">Guardar cambios</x-button>
            </div>
            @endif
        </x-slot>
    </x-card>
</div>