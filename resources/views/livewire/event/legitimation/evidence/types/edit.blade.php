<div>
    <x-card icon="fas fa-gavel" title="Nuevo tipo de evidencia">
        <div class="grid grid-cols-12">
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Archivo</p>
                <p class="text-sm">
                    {{__("Elige el archivo que deseas utilizar como ejemplo del correcto llenado de la evidencia.")}}
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
                <p class="font-bold">Nombre del tipo de evidencia</p>
                <p class="text-sm">
                    {{__("Es el nombre del tipo de la evidencia que se mostrara en el apartado de evidencias.")}}
                </p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <x-input type="text" model="evidence.name" defer="true" label="Nombre"></x-input>
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Descripción</p>
                <p class="text-sm">
                    {{__("Describe de forma clara y concisa las características de este tipo de evidencia.")}}
                </p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <x-input type="text" model="evidence.description" defer="true" label="Descripción"></x-input>
            </div>
        </div>

        <x-slot name="footer">
            <div wire:loading wire:target="file">
                Espera un momento, estamos subiendo el documento.
            </div>
            <div wire:loading.remove wire:target="file">
                <x-button color="blue" icon="fas fa-upload" click="save">Actualizar evidencia</x-button>
            </div>

        </x-slot>
    </x-card>
</div>