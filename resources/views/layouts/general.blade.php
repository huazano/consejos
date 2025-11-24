<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistema de legitimación - Siconecta</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <div class="h-screen w-full flex overflow-hidden">
        <x-layout.general.navigation-menu></x-layout.general.navigation-menu>

        <main class="pt-2 pb-2 px-5 flex-1 bg-gray-200 dark:bg-black
                transition duration-500 ease-in-out overflow-y-auto">
            <h1 class="mt-2 text-2xl font-bold">{{$title}}</h1>
            {{ $slot }}
        </main>
    </div>
    @livewireScripts
    <script src="{{ asset('js/sweetalerts.js') }}?v=11"></script>
</body>

</html>