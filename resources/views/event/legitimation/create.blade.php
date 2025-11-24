<x-general-layout>
    <x-slot name="title">Legitimaciones</x-slot>
    <x-layout.general.breadcrumbs>
        <x-layout.general.breadcrumb-option name="Legitimaciones" arrow="true" :route="route('legitimation.index')" />
        <x-layout.general.breadcrumb-option name="Crear" arrow="false" />
    </x-layout.general.breadcrumbs>
    @livewire('event.legitimation.create')
</x-general-layout>