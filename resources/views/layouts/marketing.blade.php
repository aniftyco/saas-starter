@extends('layouts.root')

@section('main')
  <header class="mx-auto mb-12 flex w-full max-w-7xl items-center justify-between p-4">
    <a class="flex items-center gap-2" href="{{ route('home') }}">
      <x-logo class="size-8" />
      <span class="text-primary-600 text-2xl font-semibold">{{ config('app.name') }}</span>
    </a>
    <ul class="flex items-center space-x-20 font-medium">
      <li><a class="hover:underline" href="#features">Features</a></li>
      <li><a class="hover:underline" href="#pricing">Pricing</a></li>
      <li><a class="hover:underline" href="#">Blog</a></li>
    </ul>

    <div class="flex items-center space-x-6">
      <a class="font-semibold hover:underline" href="{{ route('sign-in') }}">Sign In</a>
      <a class="bg-primary-600 hover:bg-primary-500 text-primary-50/90 rounded-md px-4 py-2 font-medium"
        href="{{ route('sign-up') }}"
      >Sign Up</a>
    </div>
  </header>
  <main class="mx-auto w-full max-w-7xl flex-1 px-4">
    @yield('content')
  </main>
  <footer class="mx-auto w-full max-w-7xl px-4">
    <p class="py-24 text-center text-sm text-gray-500">Copyright &copy; {{ now()->format('Y') }} <span
        class="font-medium">{{ env('APP_NAME') }}</span>. All rights reserved.</p>
  </footer>
@endsection
