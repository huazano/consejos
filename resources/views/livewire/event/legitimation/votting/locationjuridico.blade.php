<x-card title="Boleta parcial sede {{$location->name}}">
    <div class="grid grid-cols-12">
        <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
            <p class="font-bold">{{__('Boletas totales')}}</p>
            <p class="text-sm">
                {{__("Es el número de boletas que fueron entregadas a la sede.")}}
            </p>
        </div>
        <div class="col-span-8 pl-4 mb-3 pt-3">
            {{$location->boletas}}
        </div>
        <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
            <p class="font-bold">{{__('Con derecho a voto')}}</p>
            <p class="text-sm">
                {{__("Es el total de trabajadores que estan en el padrón.")}}
            </p>
        </div>
        <div class="col-span-8 pl-4 mb-3 pt-3">
            {{$location->guests()->count()}}
        </div>
        <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
            <p class="font-bold">{{__('Con derecho a voto')}}</p>
            <p class="text-sm">
                {{__("Es el total de trabajadores que estan en el padrón.")}}
            </p>
        </div>
        <div class="col-span-8 pl-4 mb-3 pt-3">
            <x-input type="number" label="Emitidos" min="0" model="location.juridico_derecho" defer="true"></x-input>
        </div>
        <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
            <p class="font-bold">{{__('Votos Emitidos')}}</p>
            <p class="text-sm">
                {{__("Es la suma de todos los votos depositados en las urnas y que fuerón efectivamente emitidos por los
                trabajadores.")}}
            </p>
        </div>
        <div class="col-span-8 pl-4 mb-3 pt-3">
            <x-input type="number" label="Emitidos" min="0" model="location.juridico_emitidos" defer="true"></x-input>
        </div>
        <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
            <p class="font-bold">{{__('Votos SI')}}</p>
            <p class="text-sm">
                {{__("Es el número de votos que indicaron el SI.")}}
            </p>
        </div>
        <div class="col-span-8 pl-4 mb-3 pt-3">
            <x-input type="number" label="Si" min="0" model="location.juridico_si" defer="true"></x-input>
        </div>
        <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
            <p class="font-bold">{{__('Votos NO')}}</p>
            <p class="text-sm">
                {{__("Es el número de votos que indicaron el NO.")}}
            </p>
        </div>
        <div class="col-span-8 pl-4 mb-3 pt-3">
            <x-input type="number" label="No" min="0" model="location.juridico_no" defer="true"></x-input>
        </div>
        <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
            <p class="font-bold">{{__('Votos VALIDOS')}}</p>
            <p class="text-sm">
                {{__("Es la suma de los votos SI más votos NO.")}}
            </p>
        </div>
        <div class="col-span-8 pl-4 mb-3 pt-3">
            <x-input type="number" label="Validos" min="0" model="location.juridico_validos" defer="true"></x-input>
        </div>
        <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
            <p class="font-bold">{{__('Votos NULOS')}}</p>
            <p class="text-sm">
                {{__("Son los votos que no tienen un sentido del voto.")}}
            </p>
        </div>
        <div class="col-span-8 pl-4 mb-3 pt-3">
            <x-input type="number" label="Nulos" min="0" model="location.juridico_nulos" defer="true"></x-input>
        </div>
        <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
            <p class="font-bold">{{__('Boletas inutilizadas')}}</p>
            <p class="text-sm">
                {{__("Son las boletas que no fueron utilizadas al final del evento.")}}
            </p>
        </div>
        <div class="col-span-8 pl-4 mb-3 pt-3">
            <x-input type="number" label="Anulados" min="0" model="location.juridico_anulados" defer="true"></x-input>
        </div>
    </div>
    <x-slot name="footer">
        <x-button color="blue" icon="fas fa-save" click="save">Guardar cambios</x-button>
    </x-slot>
</x-card>