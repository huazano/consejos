<x-general-layout>
    <x-slot name="title">{{__('Users')}}</x-slot>
    <x-layout.general.breadcrumbs>
        <x-layout.general.breadcrumb-option name="{{__('Users')}}" arrow="false" />
    </x-layout.general.breadcrumbs>

    @livewire('user.table')
</x-general-layout>