<x-general-layout>
    <x-slot name="title">Seguimiento de las sedes</x-slot>
    <x-layout.general.breadcrumbs>
        <x-layout.general.breadcrumb-option name="Legitimaciones" arrow="true" />
        <x-layout.general.breadcrumb-option name="{{$event->name}}" arrow="true"
            :route="route('legitimation.show',['event' => $event->id])" />
        <x-layout.general.breadcrumb-option name="Estadísticas" arrow="false" />
    </x-layout.general.breadcrumbs>
    @livewire('event.legitimation.statistics.index', ['event' => $event->id])
</x-general-layout>