<x-login-layout>
    <section class="min-h-screen flex items-stretch text-white">
        <div class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center z-0"
            style="background-image: url({{asset('img/login_background.jpg')}});">
            <div class="clouds z-10"></div>
            <div class="w-full px-24 z-20">
                <h1 class="text-5xl font-bold text-left tracking-wide">Sistema de legitimación</h1>
                <p class="text-3xl my-4">Sindicato Único de trabajadores Electricistas de la República Mexicana</p>
                <p class="text-lg my-4">"Por la transformación de México"</p>
            </div>
            <div class="bottom-0 absolute p-4 text-center right-0 left-0 flex justify-center space-x-4 z-20">
                <a href="https://twitter.com/suterm_nacional" target="_blank">
                    <i class="fab fa-twitter text-2xl"></i>
                </a>
                <a href="https://www.facebook.com/SutermNacional" target="_blank">
                    <i class="fab fa-facebook-f text-2xl"></i>
                </a>
                <a href="https://suterm.mx" target="_blank">
                    <i class="fas fa-home text-2xl"></i>
                </a>
                <a href="{{route('legitimation.index')}}">
                    <i class="fas fa-cogs text-2xl"></i>
                </a>
            </div>
        </div>
        <div class="lg:w-1/2 w-full flex items-center justify-center text-center md:px-16 px-0 z-0"
            style="background-color: #161616;">
            <div class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center"
                style="background-image: url({{asset('img/login_background.jpg')}});">
                <div class="absolute stars z-0 inset-0"></div>
                <div class="clouds"></div>
            </div>
            <div class="w-full py-6 z-20">
                @livewire('home.location')

            </div>
        </div>
    </section>
</x-login-layout>