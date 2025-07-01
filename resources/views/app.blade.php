<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- ICONS --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
        {{-- FONTS --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        
        <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @inertiaHead
        @routes
    </head>
    <body>
      @inertia
    </body>
</html>
