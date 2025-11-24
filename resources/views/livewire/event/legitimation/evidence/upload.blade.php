<div>
    <x-card title="Subir nueva evidencia">
        <div class="grid grid-cols-12">
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Nombre</p>
                <p class="text-sm">Es el nombre de la evidencia.</p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <x-input type="text" label="Nombre" model="name" defer="true" />
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">{{__('Tipo de evidencia')}}</p>
                <p class="text-sm">Es el tipo de evidencia que requieres que suban.</p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <select class="w-full" wire:model.defer="type">
                    <option value="none" selected disabled>Elige un tipo de evidencia</option>
                    @foreach ($types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="type"></x-jet-input-error>
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Subir evidencia</p>
                <p class="text-sm">Da click en el boton "Subir evidencia" y elige el documento que deseas subir como
                    evidencia de la Legitimación</p>
            </div>
            <div class="col-span-8 pl-4 mb-3 pt-3">
                <div class="py-3 center mx-auto w-full text-left flex">
                    <div class="bg-white px-4 py-5 rounded-lg text-left w-64">
                        <label class="cursor-pointer mt-6 mb-5">
                            <span
                                class="mt-2 text-base leading-normal px-4 py-2 bg-blue-500 text-white text-sm rounded-full">
                                {{$file ? 'Cambiar archivo': __('Subir evidencia')}}
                            </span>
                            <input type='file' class="hidden" wire:model="file" />
                        </label>
                        <x-jet-input-error for="file" class="mt-5"></x-jet-input-error>
                    </div>
                    @if ($file)
                    <div class="text-left w-full mt-5">
                        {{$file->getClientOriginalName()}}
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <x-slot name="footer">
            <x-button icon="fas fa-save" color="blue" click="save">Guardar cambios</x-button>
        </x-slot>
    </x-card>
</div>