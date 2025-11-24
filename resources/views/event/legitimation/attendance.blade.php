<x-general-layout>
    <x-slot name="title">Legitimaciones</x-slot>
    <x-layout.general.breadcrumbs>
        <x-layout.general.breadcrumb-option name="Legitimaciones" arrow="true"
            :route="route('legitimation.show',['event' => $event])" />
        <x-layout.general.breadcrumb-option name="Pase de asistencia" arrow="false" />
    </x-layout.general.breadcrumbs>

    @livewire('event.legitimation.attendance.index', ['event' => $event])
</x-general-layout>