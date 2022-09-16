<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite(['resources/css/app.css'])
        <title>{{ $title }} - Passou Ganhou</title>
    </head>
    <body class="antialiased">
       <x-header />

        <main>
            {{ $main }}
        </main>

        <x-footer />
        @vite(['resources/js/app.js'])
    </body>
</html>
