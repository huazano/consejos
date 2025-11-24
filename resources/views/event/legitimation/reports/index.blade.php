<x-general-layout>
    <x-slot name="title">Estadísticas y Reportes</x-slot>
    <x-layout.general.breadcrumbs>
        <x-layout.general.breadcrumb-option name="Legitimaciones" arrow="true" :route="route('legitimation.index')" />
        <x-layout.general.breadcrumb-option name="{{$event->name}}" arrow="true"
            :route="route('legitimation.show',['event' => $event->id])" />
        <x-layout.general.breadcrumb-option name="Estadísticas y reportes" arrow="false" />
    </x-layout.general.breadcrumbs>
    @livewire('event.legitimation.reports.index', ['event' => $event->id])
</x-general-layout>