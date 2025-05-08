@php
    function renderServiceIcon($service)
    {
        if ($service->name) {
            return '
                <img src="' .
                asset('storage/' . $service->image) .
                '" alt="Default Profile" class="h-10 w-10 rounded-full object-cover">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                <span class="text-sm font-medium text-indigo-400">' .
                e($service->name) .
                '</span>
            ';
        } else {
            return '
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
            ';
        }
    }
@endphp


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        .search-input {
            width: 100%;
            max-width: 500px;
            border: 1px solid #E5E7EB;
            border-radius: 9999px;
            padding: 0.75rem 1rem;
            outline: none;
        }

        .search-button {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            background-color: #8B5CF6;
            color: white;
            border-radius: 9999px;
            width: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .category-card {}

        .category-card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .category-icon {
            width: 30px;
            height: 30px;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body class="antialiased">
    <!-- Header/Navigation -->
    <x-header />

    <!-- Hero Section -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                <span class="block">Find Home</span>
                <span class="block text-indigo-600">Service/Repair</span>
                <span class="block">Near You</span>
            </h1>
            <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                Explore Best Home Service & Repair near you
            </p>

            <!-- Search Form -->
            <div class="mt-10 max-w-xl mx-auto relative">
                <form action="{{ route('search') }}" method="GET">
                    <input type="text" name="query" placeholder="Search" class="search-input" required
                        style="border-radius: 1.5rem">
                    <button type="submit" class="search-button"
                        style="width: 8%;margin-right: 2.3rem ; border-start-start-radius:0 ;border-end-start-radius:0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>


            <!-- Service Categories -->
            <div id="services" class="mt-16 grid grid-cols-2 gap-1 md:grid-cols-3 lg:grid-cols-6 px-16"
                style="padding: 0 200px ;">
                @foreach ($services as $service)
                    <a href="{{ route('services.category', $service->name) }}" style="all: unset !important">
                        <div style="width: 80%"
                            class="flex flex-col items-center justify-center bg-purple-50 p-5 rounded-lg cursor-pointer hover:scale-110 transition-all ease-in-out
 ml-4">

                            @switch(strtolower($service->name))
                                @case('cleaning')
                                    {!! renderServiceIcon($service) !!}
                                @break

                                @case('repair')
                                    {!! renderServiceIcon($service) !!}
                                @break

                                @case('painting')
                                    {!! renderServiceIcon($service) !!}
                                @break

                                @case('shifting')
                                    {!! renderServiceIcon($service) !!}
                                @break

                                @case('plumbing')
                                    {!! renderServiceIcon($service) !!}
                                @break

                                @case('electric')
                                    {!! renderServiceIcon($service) !!}
                                @break

                                @default
                                    {!! renderServiceIcon($service) !!}
                                @break
                            @endswitch
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Popular Business Section -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Popular Business</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($popularProviders as $provider)
                    <x-provider-card :provider="$provider" />
                @endforeach
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('services.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                    View All Services
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />


    <!-- JavaScript for dropdown menu -->

</body>

</html>
