<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <meta name="crsf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#4f46e5">

    @vite(['resources/client/app.css'])
  </head>

  <body
    class="selection:bg-primary-500 selection:text-primary-50 bg-background-100 text-background-800 dark:bg-background-900 dark:text-background-300 flex h-screen flex-col font-sans subpixel-antialiased"
  >
    @yield('main')
  </body>

</html>
