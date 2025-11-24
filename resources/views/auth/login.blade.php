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
                <h1 class="my-6">
                    <img class="m-auto" src="{{asset('svg/suterm.png')}}" />
                    <img class="m-auto h-12 mt-2" src="{{asset('svg/logo_name.svg')}}" />
                </h1>
                <form method="post" action="{{route('login')}}" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
                    @csrf
                    <div class="pb-2 pt-4">
                        <input type="text" name="username" id="username" placeholder="{{__("Username")}}"
                            value="{{old('username')}}" class="block w-full p-4 text-lg rounded-sm bg-black" required
                            autofocus autocomplete="off">
                    </div>
                    <div class="pb-2 pt-4">
                        <input class="block w-full p-4 text-lg rounded-sm bg-black" type="password" name="password"
                            id="password" placeholder="{{__('Password')}}" required autocomplete="current-password">
                        <div class="mt-3">{{$errors->first('username')}}</div>
                    </div>
                    <div class="px-4 pb-2 pt-4">
                        <button
                            class="uppercase block w-full p-4 text-lg rounded-full bg-red-500 hover:bg-red-600 focus:outline-none">{{__('Sign In')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-login-layout>