<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Formulario') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        <link rel="stylesheet" href="{{ asset('build/assets/app.bcf9949f.css') }}">
        <script src="{{ asset('build/assets/app.a1dd5ee6.js') }}"></script>
    </head>
    <body class="bg-gray-100">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-7 m-8">
            {{ $slot }}
        </div>
        <div class="flex flex-row w-full justify-center items-center">
            <span class="font-light text-gray-400">Powered by</span>
            <img class="h-16 w-16" src="{{ asset('images/logo_miit.png') }}" alt="logo_miit">
        </div>

        {{ $script ?? '' }}
    </body>
</html>



