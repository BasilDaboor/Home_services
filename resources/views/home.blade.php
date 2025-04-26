<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home Service Marketplace</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .service-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header/Navigation -->
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

    <!-- Hero Section with Search -->
    <section class="py-16 text-center">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Find Home <span class="text-purple-600">Service/Repair</span><br> Near You
            </h1>
            <p class="text-gray-500 mb-10">Explore Best Home Service & Repair near you</p>

            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto mb-16">
                <form action="{{ route('search') }}" method="GET" class="flex">
                    <input type="text" name="query"
                        class="w-full px-6 py-4 rounded-l-lg border-2 border-gray-200 focus:outline-none"
                        placeholder="Search">
                    <button type="submit" class="bg-purple-600 text-white px-6 py-4 rounded-r-lg">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Service Categories -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @php
                    // Map service names to icons and colors
                    $iconMap = [
                        'Cleaning' => ['icon' => 'fa-broom', 'color' => 'text-purple-500'],
                        'Repair' => ['icon' => 'fa-tools', 'color' => 'text-yellow-500'],
                        'Painting' => ['icon' => 'fa-paint-roller', 'color' => 'text-teal-500'],
                        'Shifting' => ['icon' => 'fa-truck', 'color' => 'text-red-500'],
                        'Plumbing' => ['icon' => 'fa-faucet', 'color' => 'text-orange-500'],
                        'Electric' => ['icon' => 'fa-bolt', 'color' => 'text-blue-500'],
                    ];
                @endphp

                @foreach ($services as $service)
                    @php
                        $icon = $iconMap[$service->name] ?? ['icon' => 'fa-concierge-bell', 'color' => 'text-gray-500'];
                    @endphp
                    <a href="{{ route('search', ['service_id' => $service->id]) }}"
                        class="bg-purple-50 rounded-lg p-6 hover:shadow-md transition duration-300">
                        <div class="service-icon {{ $icon['color'] }}">
                            <i class="fas {{ $icon['icon'] }} fa-2x"></i>
                        </div>
                        <h3 class="text-purple-600">{{ $service->name }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Popular Business Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold mb-8">Popular Business</h2>

            <!-- Business Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
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
                        <p class="text-gray-500">No service providers found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add AJAX search functionality if needed
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                // You can add AJAX functionality here if needed
                // Otherwise, the form will submit normally
            });
        });
    </script>
</body>

</html>
