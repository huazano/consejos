<x-general-layout>
    <x-slot name="title">Resultados parciales del evento</x-slot>
    <x-layout.general.breadcrumbs>
        <x-layout.general.breadcrumb-option name="Legitimaciones" arrow="true" />
        <x-layout.general.breadcrumb-option name="{{$event->name}}" arrow="true"
            :route="route('legitimation.show',['event' => $event->id])" />
        <x-layout.general.breadcrumb-option name="Parciales" arrow="false" />
    </x-layout.general.breadcrumbs>
    @livewire('event.legitimation.votting', ['event' => $event])
</x-general-layout>