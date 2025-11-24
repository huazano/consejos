<x-card title="Resultado de votación por sección - Sede: {{$location->name}} Sección: {{$door->name}}">
    <div class="grid grid-cols-12">
        <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
            <p class="font-bold">{{__('Votos SI')}}</p>
            <p class="text-sm">
                {{__("Es el número de votos que indicaron el SI.")}}
            </p>
        </div>
        <div class="col-span-8 pl-4 mb-3 pt-3">
            <x-input type="number" label="Si" min="0" model="door.si" defer="true"></x-input>
        </div>
        <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
            <p class="font-bold">{{__('Votos NO')}}</p>
            <p class="text-sm">
                {{__("Es el número de votos que indicaron el NO.")}}
            </p>
        </div>
        <div class="col-span-8 pl-4 mb-3 pt-3">
            <x-input type="number" label="No" min="0" model="door.no" defer="true"></x-input>
        </div>
        <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
            <p class="font-bold">{{__('Votos NULOS')}}</p>
            <p class="text-sm">
                {{__("Son los votos que no tienen un sentido del voto.")}}
            </p>
        </div>
        <div class="col-span-8 pl-4 mb-3 pt-3">
            <x-input type="number" label="Nulos" min="0" model="door.nulos" defer="true"></x-input>
        </div>
    </div>
    <x-slot name="footer">
        <x-button color="blue" icon="fas fa-save" click="save">Guardar cambios</x-button>
    </x-slot>
</x-card>