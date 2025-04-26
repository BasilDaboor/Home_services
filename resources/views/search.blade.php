<!-- resources/views/search.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Search Results - Home Service Marketplace</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    <!-- Header/Navigation (same as home page) -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center">
                <div class="mr-2">
                    <svg class="h-10 w-10 text-purple-500" viewBox="0 0 100 100" fill="currentColor">
                        <path
                            d="M50,0 C77.6,0 100,22.4 100,50 C100,77.6 77.6,100 50,100 C22.4,100 0,77.6 0,50 C0,22.4 22.4,0 50,0 Z M50,20 C33.4,20 20,33.4 20,50 C20,66.6 33.4,80 50,80 C66.6,80 80,66.6 80,50 C80,33.4 66.6,20 50,20 Z">
                        </path>
                    </svg>
                </div>
                <h1 class="text-xl font-bold text-gray-800">Logoipsum</h1>
            </div>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="{{ route('home') }}" class="text-gray-800 hover:text-purple-600">Home</a></li>
                    <li><a href="#" class="text-gray-800 hover:text-purple-600">Services</a></li>
                    <li><a href="#" class="text-gray-800 hover:text-purple-600">About Us</a></li>
                </ul>
            </nav>
            <div class="w-10 h-10 rounded-full bg-gray-300 overflow-hidden">
                @auth
                    <img src="/api/placeholder/100/100" alt="{{ Auth::user()->first_name }}"
                        class="w-full h-full object-cover">
                @else
                    <a href="{{ route('login') }}"
                        class="flex items-center justify-center w-full h-full bg-purple-600 text-white">
                        <i class="fas fa-user"></i>
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Search Results Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold">
                    @if ($query)
                        Search Results for "{{ $query }}"
                    @elseif($serviceId)
                        {{ $services->find($serviceId)->name ?? 'Service' }} Providers
                    @else
                        All Service Providers
                    @endif
                </h2>

                <!-- Search Bar -->
                <div class="max-w-md">
                    <form action="{{ route('search') }}" method="GET" class="flex">
                        <input type="text" name="query" value="{{ $query }}"
                            class="w-full px-4 py-2 rounded-l-lg border-2 border-gray-200 focus:outline-none"
                            placeholder="Search">
                        @if ($serviceId)
                            <input type="hidden" name="service_id" value="{{ $serviceId }}">
                        @endif
                        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-r-lg">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Filter Tabs -->
            <div class="flex overflow-x-auto space-x-2 mb-8 pb-2">
                <a href="{{ route('search', ['query' => $query]) }}"
                    class="px-4 py-2 rounded-full whitespace-nowrap {{ !$serviceId ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                    All Services
                </a>

                @foreach ($services as $service)
                    <a href="{{ route('search', ['query' => $query, 'service_id' => $service->id]) }}"
                        class="px-4 py-2 rounded-full whitespace-nowrap {{ $serviceId == $service->id ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                        {{ $service->name }}
                    </a>
                @endforeach
            </div>

            <!-- Results Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($providers as $provider)
                    <div class="bg-white rounded-lg overflow-hidden shadow">
                        <div class="h-56 overflow-hidden">
                            <img src="/api/placeholder/500/400"
                                alt="{{ $provider->business_name ?? $provider->service->name }}"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <span
                                class="inline-block bg-purple-100 text-purple-600 text-xs px-3 py-1 rounded-full mb-2">{{ $provider->service->name }}</span>
                            <h3 class="text-xl font-bold mb-1">
                                {{ $provider->business_name ?? $provider->service->name }}</h3>
                            <p class="text-purple-600 mb-1">{{ $provider->user->first_name }}
                                {{ $provider->user->last_name }}</p>
                            <p class="text-gray-500 text-sm mb-4">
                                {{ $provider->user->address ?? 'Location not specified' }}</p>
                            <div class="flex justify-between items-center">
                                <a href="{{ route('bookings.create', ['provider' => $provider->id]) }}"
                                    class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Book
                                    Now</a>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span>{{ number_format($provider->rating, 1) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-8">
                        <div class="bg-purple-50 p-8 rounded-lg">
                            <i class="fas fa-search text-purple-300 text-5xl mb-4"></i>
                            <h3 class="text-xl font-bold mb-2">No results found</h3>
                            <p class="text-gray-500">Try adjusting your search criteria or browse all available
                                services.</p>
                            <a href="{{ route('home') }}"
                                class="inline-block mt-4 bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition">
                                Back to Home
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $providers->appends(['query' => $query, 'service_id' => $serviceId])->links() }}
            </div>
        </div>
    </section>

    <!-- Footer (same as home page) -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">About Us</h3>
                    <p class="text-gray-400">We connect you with trusted service providers in your area for all your
                        home service needs.</p>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Services</h3>
                    <ul class="space-y-2 text-gray-400">
                        @foreach ($services->take(6) as $service)
                            <li><a href="{{ route('search', ['service_id' => $service->id]) }}"
                                    class="hover:text-white">{{ $service->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-map-marker-alt mr-2"></i> 123 Service Ave, NYC</li>
                        <li><i class="fas fa-phone mr-2"></i> +1 (555) 123-4567</li>
                        <li><i class="fas fa-envelope mr-2"></i> info@homeservice.com</li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="bg-gray-700 w-10 h-10 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="bg-gray-700 w-10 h-10 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class="bg-gray-700 w-10 h-10 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="bg-gray-700 w-10 h-10 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Home Service Marketplace. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>
