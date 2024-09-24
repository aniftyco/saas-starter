<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <title inertia>{{ config('app.name') }}</title>

    {{-- Scripts --}}
    @vite(['resources/client/app.css', 'resources/client/app.ts'])
    @routes
    @inertiaHead
  </head>

  <body class="font-sans antialiased">
    @yield('app')
  </body>

</html>
