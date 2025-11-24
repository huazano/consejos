<div>
    <x-card title="Solicitar nueva evidencia">
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
                <p class="font-bold">{{__('Fecha requerida')}}</p>
                <p class="text-sm">Es la fecha en que requieres se suba la evidencia.</p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <x-input type="date" label="Fecha" model="limit" defer="true" />
            </div>
        </div>
        <x-slot name="footer">
            <x-button icon="fas fa-save" color="blue" click="save">Guardar cambios</x-button>
        </x-slot>
    </x-card>
</div>