<x-general-layout>
    <x-slot name="title">{{__('Users')}}</x-slot>
    <x-layout.general.breadcrumbs>
        <x-layout.general.breadcrumb-option name="{{__('Users')}}" arrow="true" :route="route('users.index')" />
        <x-layout.general.breadcrumb-option name="{{$user->name}} ({{$user->username}})" arrow="false" />
    </x-layout.general.breadcrumbs>

    @livewire('user.edit', ['user' => $user])
</x-general-layout>