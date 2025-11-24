<x-general-layout>
    <x-slot name="title">Legitimaciones</x-slot>
    <x-layout.general.breadcrumbs>
        <x-layout.general.breadcrumb-option name="Legitimaciones" arrow="true" :route="route('legitimation.index')" />
        <x-layout.general.breadcrumb-option :name="$event->name" arrow="true"
            :route="route('legitimation.show',compact('event'))" />
        <x-layout.general.breadcrumb-option name="Expediente" arrow="false" />
    </x-layout.general.breadcrumbs>

    @livewire('event.legitimation.archive.index', compact('event'))
</x-general-layout>