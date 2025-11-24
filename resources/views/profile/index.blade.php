<x-general-layout>
    <x-slot name="title">{{__('My profile')}}</x-slot>
    <x-layout.general.breadcrumbs>
        <x-layout.general.breadcrumb-option name="{{__('My profile')}}" arrow="false" />
    </x-layout.general.breadcrumbs>
    @livewire('profile.change-password')
</x-general-layout>