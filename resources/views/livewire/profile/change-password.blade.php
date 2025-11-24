<div>
    @if (Auth::user()->change_password == 1)
    <x-alert name="{{__('You need to change your password to continue.')}}" color="yellow" icon="fas fa-exclamation" />
    @endif
    <x-card icon="fas fa-key" :title="__('Cambio de contraseña')">
        <div class="grid grid-cols-12">
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">{{__('Current password')}}</p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <x-input type="password" :label="__('Current password')" model="oldPassword"></x-input>
            </div>
        </div>
        <div class="grid grid-cols-12">
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">{{__('New password')}}</p>
                <p class="font-sm">{{__('The password must have at least:')}}</p>
                <p class="font-sm">{{__('6 Characters')}}</p>
                <p class="font-sm">{{__('At least 1 character in capital letters')}}</p>
                <p class="font-sm">{{__('At least 1 lowercase character')}}</p>
                <p class="font-sm">{{__('At least 1 number')}}</p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <x-input type="password" :label="__('New password')" model="newPassword"></x-input>
            </div>
        </div>
        <div class="grid grid-cols-12">
            <div class="col-span-4 text-right pt-3 border-r pr-4 mb-3">
                <p class="font-bold">{{__('Repeat new password')}}</p>
            </div>
            <div class="col-span-8 pl-4 mb-3">
                <x-input type="password" :label="__('Repeat new password')" model="newConfirmPassword"></x-input>
            </div>
        </div>
        <x-slot name="footer">
            <x-button click="changePassword()">Cambiar contraseña</x-button>
        </x-slot>
    </x-card>
</div>