<x-general-layout>
    <x-slot name="title">Sedes {{$location->name}}</x-slot>
    <x-layout.general.breadcrumbs>
        <x-layout.general.breadcrumb-option name="Legitimaciones" arrow="true" />
        <x-layout.general.breadcrumb-option name="{{$event->name}}" arrow="true"
            :route="route('legitimation.show',['event' => $event->id])" />
        <x-layout.general.breadcrumb-option name="Sedes" arrow="true"
            :route="route('legitimation.locations',['event' => $event->id])" />
        <x-layout.general.breadcrumb-option name="Sedes {{$location->name}}" arrow="false" />
    </x-layout.general.breadcrumbs>
    @livewire('event.legitimation.location.location', ['event' => $event->id,'location' => $location->id])
</x-general-layout>