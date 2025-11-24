<div class="p-2">
    @if ($location)
    <div class="text-left">
        <p class="text-xl">Trabajador: <span class="text-yellow-600 font-bold">{{$user->name}}</span></p>
        <p class="text-xl">Dirección: <span class="text-yellow-600 font-bold">{{$user_location->description}}</span></p>
        <p class="text-xl">Fecha de la votación: <span class="text-yellow-600 font-bold">01/12/2021</span>
        </p>
        <p class="text-xl">Horario de votación: <span
                class="text-yellow-600 font-bold">{{$user_location->schedule}}</span></p>
    </div>
    @if ($user_location->georeferences)
    <iframe src="{{$user_location->georeferences}}" width="600" height="450" style="border:0; max-width:100%"
        allowfullscreen="" loading="lazy"></iframe>
    @endif

    <div class="mt-5">
        @if ($user_location->convocatoria)
        <x-button icon="fas fa-download py-3" color="red" :href="Storage::url($user_location->convocatoria)"
            target="_blank">Descargar
            convocatoria</x-button>
        @endif
    </div>
    @else
    <h1 class="text-3xl">Proxima legitimación:</h1>
    <h1 class="text-5xl text-yellow-500 font-bold mb-5">CCT CFE-SUTERM</h1>
    <h1 class="text-3xl">¿Quieres conocer dónde te corresponde votar?</h1>
    <div class="pb-2 pt-4">
        <input type="text" name="username" id="username" placeholder="Ingresa tu clave de empleado"
            value="{{old('username')}}" class="block w-full p-4 text-lg rounded-sm bg-black" required autofocus
            autocomplete="off" wire:model.defer="username">
    </div>
    <div class="pb-2 pt-4">
        {!!$message!!}
    </div>
    <div class="px-4 pb-2 pt-4">
        <button type="button" wire:click="display_location()"
            class="uppercase block w-full p-4 text-lg rounded-full bg-red-500 hover:bg-red-600 focus:outline-none">Revisar
            sede</button>
    </div>
    @endif

</div>