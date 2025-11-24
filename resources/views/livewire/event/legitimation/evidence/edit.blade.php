<div>
    <x-card title="Actualizar información de la evidencia">
        <div class="grid grid-cols-12">
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Nombre</p>
                <p class="text-sm">Es el nombre de la evidencia</p>
            </div>
            <div class="col-span-8 pl-4 mb-3 pt-3">
                <p>
                    <x-input type="text" label="Nombre" model="evidence.name"></x-input>
                </p>
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Estado</p>
                <p class="text-sm">Es el estado en el que se encuentra esta evidencia</p>
            </div>
            <div class="col-span-8 pl-4 mb-3 pt-3">
                <span
                    class="bg-{{$evidence->status == 'pendiente' ? 'gray': ($evidence->status == 'en revisión' ? 'yellow':($evidence->status == 'rechazada' ? 'red':'green'))}}-500 text-white font-bold rounded px-1">
                    {{$evidence->status == 'pendiente' ? 'Evidencia pendiente de subir': ($evidence->status == 'en
                    revisión' ? 'Evidencia en proceso de revisión de jurídico':($evidence->status == 'rechazada' ?
                    'Evidencia rechazada por jurídico':'Evidencia validada por jurídico'))}}
                </span>
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Fecha limite</p>
                <p class="text-sm">Es la fecha en que deberás subir esta evidencia</p>
            </div>
            <div class="col-span-8 pl-4 mb-3 pt-3">
                <p>{{$evidence->limit_date->format('d/m/Y')}}</p>
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Ejemplo</p>
                <p class="text-sm">Es un ejemplo del documento que esperamos subas para este tipo de evidencia</p>
            </div>
            <div class="col-span-8 pl-4 mb-3 pt-3">
                <x-a href="{{$evidence->getExampleUrl()}}" target="_blank">Ver ejemplo</x-a>
            </div>
            @if ($evidence->status == 'pendiente')
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Elige el documento</p>
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

            <x-slot name="footer">
                <div wire:loading wire:target="file">
                    Espera un momento, estamos subiendo el documento.
                </div>
                @if ($file)
                <div wire:loading.remove wire:target="file">
                    <x-button color="blue" icon="fas fa-upload" click="save">Guardar cambios</x-button>
                </div>
                @endif
            </x-slot>
            @elseif($evidence->status == 'en revisión' || $evidence->status == 'rechazada' || $evidence->status ==
            'validada')
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Evidencia</p>
                <p class="text-sm">Es el documento subido por el encargado de esta sede como evidencia</p>
            </div>
            <div class="col-span-8 pl-4 mb-3 pt-3">
                <x-a href="{{Storage::url($evidence->path)}}" target="_blank">Ver evidencia</x-a>
            </div>
            @if ($evidence->status == 'en revisión')

            @if (Auth::user()->hasPermission('Jurídico') || Auth::user()->hasPermission('Administrator'))
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Cambiar estado</p>
                <p class="text-sm">Autoriza o rechaza la evidencia segun sea el caso</p>
            </div>
            <div class="col-span-8 pl-4 mb-3 pt-3">
                <select wire:change="updateStatus(event.target.value)">
                    <option value="" selected disabled>Elige una opción</option>
                    <option value="validado">Autorizar evidencia</option>
                    <option value="rechazada">Rechazar evidencia</option>
                </select>
            </div>
            @endif
            @elseif ($evidence->status == 'rechazada')
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Motivo de rechazo</p>
                <p class="text-sm">Es la razón por la cual el documento fue rechazado por jurídico</p>
            </div>
            <div class="col-span-8 pl-4 mb-3 pt-3">
                {{$evidence->comments}}
            </div>
            @if (Auth::user()->hasPermission('Jurídico') || Auth::user()->hasPermission('Administrator'))
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Cambiar estado</p>
                <p class="text-sm">Autoriza o rechaza la evidencia segun sea el caso</p>
            </div>
            <div class="col-span-8 pl-4 mb-3 pt-3">
                <select wire:change="updateStatus(event.target.value)">
                    <option value="" selected disabled>Elige una opción</option>
                    <option value="validado">Autorizar evidencia</option>
                    <option value="rechazada">Rechazar evidencia</option>
                </select>
            </div>
            @endif
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Subir nuevamente la evidencia</p>
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
            <x-slot name="footer">
                <div wire:loading wire:target="file">
                    Espera un momento, estamos subiendo el documento.
                </div>
                @if ($file)
                <div wire:loading.remove wire:target="file">
                    <x-button color="blue" icon="fas fa-upload" click="save">Guardar cambios</x-button>
                </div>
                @endif
            </x-slot>
            @endif
            @if ($evidence->status == 'validada' && (Auth::user()->hasPermission('Jurídico') ||
            Auth::user()->hasPermission('Administrator')))
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Cambiar estado</p>
                <p class="text-sm">Rechazar o marcar evidencia como pendiente de revisar</p>
            </div>
            <div class="col-span-8 pl-4 mb-3 pt-3">
                <select wire:change="updateStatus(event.target.value)">
                    <option value="" selected disabled>Elige una opción</option>
                    <option value="rechazada">Rechazar evidencia</option>
                    <option value="en revisión">En revisión</option>
                </select>
            </div>
            @if ($evidence->sended == 'no')
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Marcar como enviada al CFCRL</p>
                <p class="text-sm">Marca esta evidencia como enviada al Centro Federal de Conciliación y Registro
                    Laboral</p>
                <p class="text-sm">Nota: Subir la evidencia al CFCRL es un proceso manual, marcar la evidencia como
                    enviada al CFCRL es únicamente una medida de control para identificar los documentos que ya enviaste
                    al CFCRL.</p>
            </div>
            <div class="col-span-8 pl-4 mb-3 pt-3">
                <x-button color="blue" icon="fas fa-share-square" wire:click="setSended">Marcar como enviada</x-button>
            </div>
            @endif
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Evidencia enviada al CFCRL</p>
                <p class="text-sm">Esta evidencia ya fue subida al Centro Federal de Conciliación y Registro
                    Laboral</p>
            </div>
            <div class="col-span-8 pl-4 mb-3 pt-3">
                {{ucfirst($evidence->sended)}}
            </div>
            @endif
            @endif
        </div>


    </x-card>
</div>