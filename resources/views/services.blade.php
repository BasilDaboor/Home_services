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

    <title>Services - Trusty Hands</title>

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

        .category-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .category-item:hover {
            background-color: #F5F3FF;
        }

        .category-item.active {
            background-color: #F5F3FF;
            color: #8B5CF6;
        }

        .category-icon {
            width: 40px;
            height: 40px;
            margin-right: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body class="antialiased bg-gray-50">
    <!-- Header/Navigation -->
    <x-header />

    <!-- Services Content Section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Categories Sidebar -->
                <div class="lg:col-span-1">
                    <h2 class="text-xl font-bold text-purple-800 mb-4">Categories</h2>
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <nav class="flex flex-col space-y-1 p-2">
                            @foreach ($services as $service)
                                <a href="{{ route('services.category', $service->name) }}"
                                    class="category-item {{ $currentCategory === $service->name ? 'active' : '' }}">

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

                                </a>
                            @endforeach
                        </nav>
                    </div>
                </div>

                <!-- Service Providers -->
                <div class="lg:col-span-3">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">{{ $currentCategory }}</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($providers as $provider)
                            <x-provider-card :provider="$provider" />
                        @empty
                            <div class="col-span-3">
                                <div class="text-center py-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h3 class="mt-2 text-lg font-medium text-gray-900">No providers available</h3>
                                    <p class="mt-1 text-sm text-gray-500">We couldn't find any providers for
                                        {{ $currentCategory }} service at the moment.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('home') }}"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                                            Back to Home
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if ($providers->hasPages())
                        <div class="mt-8">
                            {{ $providers->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />

</body>

</html>
