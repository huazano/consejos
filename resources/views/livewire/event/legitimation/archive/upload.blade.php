<div>
    <x-card icon="fas fa-upload" title="Subir un nuevo documento al expediente {{$location->name ?? 'global'}}">
        <div class="grid grid-cols-12">
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Archivo</p>
                <p class="text-sm">
                    {{__("Elige el archivo que deseas subir a la plataforma")}}
                </p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <div class="py-3 center mx-auto w-full text-left flex">
                    <div class="bg-white px-4 py-5 rounded-lg text-left w-64">
                        <label class="cursor-pointer mt-6 mb-5">
                            <span
                                class="mt-2 text-base leading-normal px-4 py-2 bg-blue-500 text-white text-sm rounded-full">
                                {{$file ? 'Cambiar archivo': __('Subir documento')}}
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
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Nombre del archivo</p>
                <p class="text-sm">
                    {{__("Es el nombre con el que se mostrara el archivo en el expediente.")}}
                </p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <x-input type="text" model="name" defer="true" label="Nombre"></x-input>
            </div>
        </div>

        <x-slot name="footer">
            <div wire:loading wire:target="file">
                Espera un momento, estamos subiendo el documento.
            </div>
            @if ($file)
            <div wire:loading.remove wire:target="file">
                <x-button color="blue" icon="fas fa-upload" click="save">Subir archivo</x-button>
            </div>
            @endif
        </x-slot>
    </x-card>


</div>