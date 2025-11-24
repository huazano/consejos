<div>
    <div>
        <nav class="w-28 flex flex-col items-center bg-white dark:bg-gray-800 py-4">
            <div>
                <img src="{{asset('svg/logo.svg')}}" width="50px" height="50px" />
            </div>
            <ul class="mt-2 text-gray-700 dark:text-gray-400 capitalize w-full p-1">
                <x-layout.general.navigation-menu-option :route="route('legitimation.index')"
                    activeRoute='legitimation.*' icon="fas fa-gavel">
                    Legitimaciones
                </x-layout.general.navigation-menu-option>

                {{-- This menu can only be seen by permission:Administrador --}}
                @if(Auth::user()->hasPermission('Administrator'))
                <li class="mt-2 pt-2 text-xs font-bold text-center text-red-700 uppercase border-t border-gray-200">
                    Admin
                </li>
                <x-layout.general.navigation-menu-option :route="route('users.index')" activeRoute='users.*'
                    icon="fas fa-users">
                    {{__("Users")}}
                </x-layout.general.navigation-menu-option>

                <li class="mt-2 pt-2 text-xs font-bold text-center text-red-700 uppercase border-t border-gray-200">
                    Catálogos
                </li>
                <x-layout.general.navigation-menu-option :route="route('legitimation.evidence.types')"
                    activeRoute='users.*' icon="fas fa-gavel">
                    {{__("Evidencias")}}
                </x-layout.general.navigation-menu-option>
                @endif

                <li class="mt-2 pt-2 text-xs font-bold text-center text-red-700 uppercase border-t border-gray-200">
                </li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-layout.general.navigation-menu-option
                        onclick="event.preventDefault();this.closest('form').submit();" :route="route('logout')"
                        icon="fas fa-door-open">
                        {{__("Exit")}}
                    </x-layout.general.navigation-menu-option>
                </form>
            </ul>
        </nav>
    </div>
</div>