<x-general-layout>
    <x-slot name="title">Resultados parciales del evento</x-slot>
    <x-layout.general.breadcrumbs>
        <x-layout.general.breadcrumb-option name="Legitimaciones" arrow="true" :route="route('legitimation.index')" />
        <x-layout.general.breadcrumb-option name="{{$event->name}}" arrow="true"
            :route="route('legitimation.show',['event' => $event->id])" />
        <x-layout.general.breadcrumb-option name="Resultados por Sección" arrow="true"
            :route="route('legitimation.vottingseccion',['event' => $event->id])" />
        <x-layout.general.breadcrumb-option name="{{$door->name}}" arrow="false" />
    </x-layout.general.breadcrumbs>
    @livewire('event.legitimation.votting.seccionlocation', ['event' => $event->id,'location' => $location->id, 'door'
    => $door->id])
</x-general-layout>