<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Search Results - {{ config('app.name', 'Laravel') }}</title>

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
    </style>
</head>

<body class="antialiased bg-gray-50">
    <!-- Header/Navigation -->

    <x-header />

    <!-- Search Results Section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    Search Results for "{{ $query }}"
                </h1>
                <p class="mt-2 text-sm text-gray-600">{{ $providers->total() }} results found</p>
            </div>

            <!-- Search Form -->
            <div class="mb-8 max-w-xl relative">
                <form action="{{ route('search') }}" method="GET">
                    <input type="text" name="query" value="{{ $query }}" placeholder="Search"
                        class="search-input" required style="border-radius: 1.5rem">
                    <button type="submit" class="search-button"
                        style="width: 8%; border-start-start-radius:0 ;border-end-start-radius:0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Results Grid -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @forelse($providers as $provider)
                    <x-provider-card :provider="$provider" />
                @empty
                    <div class="col-span-full py-12">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">No results found</h3>
                            <p class="mt-1 text-sm text-gray-500">We couldn't find any providers matching
                                "{{ $query }}".</p>
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
            <div class="mt-12">
                {{ $providers->withQueryString()->links() }}
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />

</body>

</html>
