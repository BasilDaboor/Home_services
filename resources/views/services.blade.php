<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Services - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
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
    <header class="bg-white py-4 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <svg class="w-10 h-10 text-indigo-600" viewBox="0 0 40 40" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20 5C11.716 5 5 11.716 5 20C5 28.284 11.716 35 20 35C28.284 35 35 28.284 35 20C35 11.716 28.284 5 20 5Z"
                                fill="#8B5CF6" />
                            <path
                                d="M15 15C17.761 15 20 17.239 20 20C20 22.761 17.761 25 15 25C12.239 25 10 22.761 10 20C10 17.239 12.239 15 15 15Z"
                                fill="white" />
                            <path
                                d="M25 10C27.761 10 30 12.239 30 15C30 17.761 27.761 20 25 20C22.239 20 20 17.761 20 15C20 12.239 22.239 10 25 10Z"
                                fill="white" />
                        </svg>
                        <span class="ml-3 text-xl font-bold text-indigo-600">Logoipsum</span>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex space-x-10">
                    <a href="{{ route('home') }}"
                        class="text-base font-medium text-gray-500 hover:text-gray-900">Home</a>
                    <a href="{{ route('services.index') }}" class="text-base font-medium text-gray-900">Services</a>
                    <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">About Us</a>
                </nav>

                <!-- User Menu -->
                <div class="flex items-center">
                    @auth
                        <div class="ml-3 relative">
                            <div>
                                @if (auth()->user()->image)
                                    <img class="h-10 w-10 rounded-full object-cover"
                                        src="{{ asset('storage/' . auth()->user()->image) }}" alt="Profile">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-sm font-medium text-gray-600">
                                            {{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="hidden md:flex items-center space-x-4">
                            <a href="{{ route('login') }}"
                                class="text-base font-medium text-gray-500 hover:text-gray-900">Log in</a>
                            <a href="{{ route('register') }}"
                                class="ml-8 inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                                Register
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>

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
                                    <div class="category-icon"
                                        style="background-color: {{ ['#F3E8FF', '#FEF3C7', '#DCFCE7', '#E0F2FE', '#FFE4E6', '#F3F4F6'][rand(0, 5)] }};">
                                        @switch(strtolower($service->name))
                                            @case('cleaning')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                                </svg>
                                            @break

                                            @case('repair')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            @break

                                            @case('painting')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                                </svg>
                                            @break

                                            @case('shifting')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                                </svg>
                                            @break

                                            @case('plumbing')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                                </svg>
                                            @break

                                            @case('electric')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                            @break

                                            @default
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                </svg>
                                        @endswitch
                                    </div>
                                    <span class="font-medium">{{ $service->name }}</span>
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
                            {{-- <div class="bg-white rounded-lg overflow-hidden shadow-md">
                                <!-- Provider Image -->
                                <div class="h-48 bg-gray-200">
                                    @if ($provider->user->image)
                                        <img src="{{ asset('storage/' . $provider->user->image) }}"
                                            alt="{{ $provider->user->first_name }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset('images/service-providers/' . strtolower($currentCategory) . rand(1, 4) . '.jpg') }}"
                                            alt="{{ $provider->user->first_name }}"
                                            class="w-full h-full object-cover">
                                    @endif
                                </div>

                                <!-- Service Type Badge -->
                                <div class="pt-4 px-4">
                                    <span
                                        class="inline-block px-3 py-1 text-xs font-medium text-purple-800 bg-purple-100 rounded-full">
                                        {{ $provider->service->name }}
                                    </span>
                                </div>

                                <!-- Provider Info -->
                                <div class="p-4">
                                    <h3 class="text-lg font-bold text-gray-900">{{ $provider->service->name }}</h3>
                                    <p class="text-md text-indigo-600 font-medium">{{ $provider->user->first_name }}
                                        {{ $provider->user->last_name }}</p>

                                    @if ($provider->user->address)
                                        <p class="mt-2 text-sm text-gray-600">
                                            {{ $provider->user->address }}
                                        </p>
                                    @endif

                                    <a href="{{ route('provider.details', $provider->id) }}"
                                        class="mt-4 inline-block px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700">
                                        Book Now
                                    </a>
                                </div>
                            </div> --}}
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
    <footer class="bg-white mt-12">
        <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo and Description -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center">
                        <svg class="w-10 h-10 text-indigo-600" viewBox="0 0 40 40" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20 5C11.716 5 5 11.716 5 20C5 28.284 11.716 35 20 35C28.284 35 35 28.284 35 20C35 11.716 28.284 5 20 5Z"
                                fill="#8B5CF6" />
                            <path
                                d="M15 15C17.761 15 20 17.239 20 20C20 22.761 17.761 25 15 25C12.239 25 10 22.761 10 20C10 17.239 12.239 15 15 15Z"
                                fill="white" />
                            <path
                                d="M25 10C27.761 10 30 12.239 30 15C30 17.761 27.761 20 25 20C22.239 20 20 17.761 20 15C20 12.239 22.239 10 25 10Z"
                                fill="white" />
                        </svg>
                        <span class="ml-3 text-xl font-bold text-indigo-600">Logoipsum</span>
                    </div>
                    <p class="mt-4 text-gray-500 text-sm">
                        We provide high-quality home services in your area. Our team of professionals is dedicated to
                        making your home better.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-600 tracking-wider uppercase">Quick Links</h3>
                    <ul class="mt-4 space-y-4">
                        <li><a href="{{ route('home') }}"
                                class="text-base text-gray-500 hover:text-gray-900">Home</a></li>
                        <li><a href="{{ route('services.index') }}"
                                class="text-base text-gray-500 hover:text-gray-900">Services</a></li>
                        <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">About Us</a></li>
                        <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-600 tracking-wider uppercase">Contact Us</h3>
                    <ul class="mt-4 space-y-4">
                        <li class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="text-gray-500">+1 (555) 123-4567</span>
                        </li>
                        <li class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-500">info@homeservices.com</span>
                        </li>
                        <li class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-gray-500">123 Main St, Anytown, USA</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 border-t border-gray-200 pt-8">
                <p class="text-base text-gray-400 text-center">
                    &copy; {{ date('Y') }} Home Services. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>

</html>
