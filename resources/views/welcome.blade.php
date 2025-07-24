@extends('layouts.root', ['title' => 'Saas Starter - The SaaS starter you need to get shit done'])

@section('content')
    <main class="flex-1 px-4 sm:px-0">
        <section class="py-12 container mx-auto max-w-6xl grid grid-cols-1 sm:grid-cols-12 gap-8">
            <div class="col-span-1 sm:col-span-7">
                <h1 class="text-4xl sm:text-6xl font-semibold text-zinc-900 dark:text-zinc-100 tracking-tight">The SaaS
                    starter you<br />
                    need <span
                        class="bg-linear-to-r from-sky-700 dark:from-sky-200 to-sky-600 bg-clip-text text-transparent">to
                        get shit done</span>
                </h1>
                <h2 class="mt-3 sm:mt-5 text-base sm:text-xl text-zinc-500 dark:text-zinc-400">
                    A complete SaaS foundation with everything you need - ready to build upon so you can focus on creating
                    your unique product.
                </h2>
                <div class="mt-8 flex items-center">
                    <a href="#"
                        class="bg-white text-zinc-800 dark:text-zinc-400 dark:bg-zinc-900 py-1.5 px-4 border border-zinc-200 dark:border-zinc-800 rounded-full hover:bg-zinc-100 dark:hover:bg-zinc-800">
                        Deploy your own <span class="ml-3">&rarr;</span>
                    </a>
                </div>
            </div>
            <div class="col-span-1 sm:col-span-5">
                <div class="bg-white dark:bg-zinc-800 rounded-lg overflow-hidden select-none">
                    <div class="flex space-x-2 p-4 bg-zinc-200 dark:bg-zinc-900">
                        <span class="bg-red-500 rounded-full size-3 block">&nbsp;</span>
                        <span class="bg-yellow-500 rounded-full size-3 block">&nbsp;</span>
                        <span class="bg-green-500 rounded-full size-3 block">&nbsp;</span>
                    </div>
                    <div class="text-zinc-950 dark:text-white text-sm p-4 font-mono">
                        <p>
                            <span class="text-zinc-500">$</span>
                            <span class="select-text">laravel new --using starter/saas my-app</span>
                        </p>
                        <pre class="text-red-400 select-none">
   _                               _
  | |                             | |
  | |     __ _ _ __ __ ___   _____| |
  | |    / _` |  __/ _` \ \ / / _ \ |
  | |___| (_| | | | (_| |\ V /  __/ |
  |______\__,_|_|  \__,_| \_/ \___|_|
                        </pre>
                        <p class="text-green-500">Creating a "starter/saas" project at "./my-app"</p>
                    </div>

                </div>
            </div>
        </section>

        <section class="bg-white dark:bg-zinc-900">
            <ul
                class="py-6 px-4 sm:py-12 sm:px-0 container mx-auto max-w-6xl grid grid-cols-1 sm:grid-cols-3 gap-8 sm:gap-y-16">
                @foreach (['1', '2', '3', '4', '5', '6'] as $feature)
                    <li class="cols-span-1">
                        <span class="inline-block bg-sky-600 rounded-lg p-2 mr-4">
                            <svg class="w-6 h-6 text-white stroke-current fill-none" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="stroke-2" stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </span>
                        <div class="mt-3">
                            <h3 class="text-lg font-medium text-zinc-900 dark:text-zinc-100">Feature {{ $feature }}
                            </h3>
                            <p class="mt-2 text-base text-zinc-500 dark:text-zinc-400">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo tempore inventore eligendi ea
                                autem.
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>

        <section class="py-6 sm:py-12 container mx-auto max-w-6xl grid grid-cols-1 sm:grid-cols-2 items-center">
            <div class="col-span-1">
                <p class="text-4xl font-semibold text-zinc-900 dark:text-zinc-100">Ready to launch your SaaS?</p>
                <p class="mt-3 max-w-3xl text-lg text-zinc-500 dark:text-zinc-400">
                    Our starter provides everything you need to get your SaaS up and running quickly. Don't waste time on
                    boilerplate - focus on what makes your product unique.
                </p>
            </div>
            <div class="col-span-1 flex justify-center sm:justify-end mt-6 sm:mt-0">
                <a href="#"
                    class="bg-white text-zinc-800 dark:text-zinc-400 dark:bg-zinc-900 py-1.5 px-4 border border-zinc-200 dark:border-zinc-800 rounded-full hover:bg-zinc-100 dark:hover:bg-zinc-800">
                    View the code <span class="ml-3">&rarr;</span>
                </a>
            </div>
        </section>
    </main>
@endsection
