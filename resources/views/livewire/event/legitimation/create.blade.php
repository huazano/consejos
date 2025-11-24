<div>
    <x-card title="Crear nueva la legitimación" icon="fas fa-plus">
        <div class="grid grid-cols-12">
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Año del CCT</p>
                <p class="text-sm">
                    Año en que se estableció el contrato colectivo de trabajo.
                </p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <x-input type="number" label="Año del CCT" model="year"></x-input>
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Revisión</p>
                <p class="text-sm">
                    Es el número de veces que se ha intentado legitimar el CCT.
                </p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <x-input type="number" label="Revisión" model="revision"></x-input>
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Fecha de inicio</p>
                <p class="text-sm">
                    Es la fecha en que se va a iniciar la votación.
                </p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <x-input type="date" label="Fecha de inicio" model="startDate"></x-input>
            </div>
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">Fecha de cierre</p>
                <p class="text-sm">
                    Es la fecha en que se va a concluir la votación.
                </p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <x-input type="date" label="Fecha de cierre" model="endDate"></x-input>
            </div>
        </div>
        <x-slot name="footer">
            <x-button icon="fas fa-plus" color="blue" click="create()">Crear legitimación</x-button>
        </x-slot>
    </x-card>
</div>