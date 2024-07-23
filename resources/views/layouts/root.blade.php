<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="crsf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#4f46e5">
    @vite(['resources/client/app.css'])
  </head>

  <body
    class="selection:bg-primary-500 selection:text-primary-50 flex h-screen flex-col bg-gray-100 font-sans text-gray-800 subpixel-antialiased"
  >
    @yield('main')
  </body>

</html>
