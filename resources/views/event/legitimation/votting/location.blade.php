<x-general-layout>
    <x-slot name="title">Resultados parciales del evento</x-slot>
    <x-layout.general.breadcrumbs>
        <x-layout.general.breadcrumb-option name="Legitimaciones" arrow="true" :route="route('legitimation.index')" />
        <x-layout.general.breadcrumb-option name="{{$event->name}}" arrow="true"
            :route="route('legitimation.show',['event' => $event->id])" />
        <x-layout.general.breadcrumb-option name="Parciales" arrow="true"
            :route="route('legitimation.votting',['event' => $event->id])" />
        <x-layout.general.breadcrumb-option name="{{$location->name}}" arrow="false" />
    </x-layout.general.breadcrumbs>
    @livewire('event.legitimation.votting.location', ['event' => $event->id,'location' => $location->id])
</x-general-layout>