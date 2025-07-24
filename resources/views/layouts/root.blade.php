<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ $mode ?? 'light' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>

    @if (file_exists(public_path('assets/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/client/tailwind.css', 'resources/client/landing.ts'])
    @endif
    @livewireStyles
</head>

<body x-cloak class="min-h-screen bg-zinc-50 dark:bg-zinc-950 font-sans antialiased flex flex-col">
    <header class="bg-white dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-800 py-4">
        <nav class="container mx-auto max-w-6xl px-4 md:px-0 flex flex-row justify-between items-center">
            <div class="flex items-center space-x-1">
                <svg class="size-8" viewBox="-100 -100 200 200" xmlns="http://www.w3.org/2000/svg">
                    <g class="fill-sky-600 stroke-white dark:stroke-zinc-900 stroke-[6]">
                        <circle cx="0" cy="-40" r="40" />
                        <circle cx="34.64" cy="-20" r="40" />
                        <circle cx="34.64" cy="20" r="40" />
                        <circle cx="0" cy="40" r="40" />
                        <circle cx="-34.64" cy="20" r="40" />
                        <circle cx="-34.64" cy="-20" r="40" />
                        <circle cx="0" cy="0" r="40" />
                    </g>
                </svg>

                <span class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ config('app.name') }}</span>
            </div>
            <ul class="flex space-x-4 items-center">
                <li><a href="/pricing"
                        class="text-sm font-medium text-zinc-700 dark:text-zinc-500 hover:text-black dark:hover:text-white hover:underline">Pricing</a>
                </li>
                <li><a href="/sign-up"
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium bg-sky-600 hover:bg-sky-700 rounded-full py-1.5 px-3 text-white/90">Sign
                        Up</a></li>
            </ul>
        </nav>
    </header>

    @yield('content')

    <footer class="container mx-auto max-w-6xl">
        <p class="py-4 text-sm text-center text-zinc-900 dark:text-zinc-100">Copyright &copy; {{ date('Y') }} <span
                class="font-semibold">{{ config('app.name') }}</span>. All rights
            reserved.</p>
    </footer>

    @livewireScriptConfig
</body>

</html>
