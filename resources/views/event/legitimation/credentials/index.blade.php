<x-general-layout>
    <x-slot name="title">Sedes del evento</x-slot>
    <x-layout.general.breadcrumbs>
        <x-layout.general.breadcrumb-option name="Legitimaciones" arrow="true" />
        <x-layout.general.breadcrumb-option name="{{$event->name}}" arrow="true"
            :route="route('legitimation.show',['event' => $event->id])" />
        <x-layout.general.breadcrumb-option name="Credenciales" arrow="false" />
    </x-layout.general.breadcrumbs>
    @livewire('event.legitimation.credentials.index', ['event' => $event->id])
</x-general-layout>