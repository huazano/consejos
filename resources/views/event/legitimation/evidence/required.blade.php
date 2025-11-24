<x-general-layout>
    <x-slot name="title">Evidencia del evento</x-slot>
    <x-layout.general.breadcrumbs>
        <x-layout.general.breadcrumb-option name="Legitimaciones" arrow="true" :route="route('legitimation.index')" />
        <x-layout.general.breadcrumb-option :name="$event->name" arrow="true"
            :route="route('legitimation.show',compact('event'))" />
        <x-layout.general.breadcrumb-option name="Evidencia" arrow="true"
            :route="route('legitimation.evidence.index', compact('event'))" />
        <x-layout.general.breadcrumb-option name="Solicitar evidencia" arrow="false" />
    </x-layout.general.breadcrumbs>

    @livewire('event.legitimation.evidence.required', ['event' => $event->id, 'location' => $location->id ?? 'global'])
</x-general-layout>