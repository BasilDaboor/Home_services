<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
@vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="//unpkg.com/alpinejs" defer></script>
<style>
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #8B5CF6;
        border-radius: 2em;
    }

    ::-webkit-scrollbar-track {
        background-color: white;
        margin-block: .1rem;
    }
</style>
<header class="bg-white py-4 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img class="h-10 w-10 " src="{{ asset('images/home_logo.jpg') }}" alt="logo">

                    <span class="ml-3 text-xl font-bold text-indigo-600">Trusty <span
                            class="text-purple-500">Hands</span></span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-10">
                <a href="{{ route('home') }}"
                    class="text-base font-medium {{ request()->routeIs('home') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : 'text-gray-500 hover:text-gray-900' }}">
                    Home
                </a>
                <a href="{{ route('services.index') }}"
                    class="text-base font-medium {{ request()->routeIs('services.*') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : 'text-gray-500 hover:text-gray-900' }}">
                    Services
                </a>
                <a href="{{ route('aboutUs') }}"
                    class="text-base font-medium {{ request()->routeIs('aboutUs') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : 'text-gray-500 hover:text-gray-900' }}">
                    About Us
                </a>
                <a href="{{ route('contact.index') }}"
                    class="text-base font-medium {{ request()->routeIs('contact.*') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : 'text-gray-500 hover:text-gray-900' }}">
                    Contact Us
                </a>
            </nav>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" id="mobile-menu-button"
                    class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Hamburger icon -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- User Menu -->
            <div class="hidden md:flex items-center">
                <!-- User Menu -->
                <div class="flex items-center">
                    @auth
                        <div class="ml-3 relative" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" type="button"
                                    class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
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
                                </button>
                            </div>

                            <!-- Dropdown menu, show/hide based on menu state -->
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                                style="z-index: 100">

                                <!-- User Info -->
                                <div class="block px-4 py-2 text-xs text-gray-500 border-b border-gray-100">
                                    <div class="font-medium text-gray-900">{{ auth()->user()->first_name }}
                                        {{ auth()->user()->last_name }}</div>
                                    <div class="text-xs text-gray-500 mt-0.5">{{ auth()->user()->email }}</div>
                                </div>

                                <!-- Dashboard Link -->
                                @if (auth()->user()->role === 'customer' || auth()->user()->role === 'provider')
                                    <a href="{{ route('profile.show') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Profile</a>
                                @elseif(auth()->user()->role === 'admin' || auth()->user()->role === 'super_admin')
                                    <a href="{{ route('dashboard.home') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Admin Dashboard</a>
                                @endif


                                <!-- Logout -->
                                <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-100">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center space-x-4">
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

        <!-- Mobile menu -->
        <div class="md:hidden" id="mobile-menu" style="display: none;">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200 mt-4">
                <a href="{{ route('home') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
                    Home
                </a>
                <a href="{{ route('services.index') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('services.*') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
                    Services
                </a>
                <a href="{{ route('aboutUs') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('aboutUs') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
                    About Us
                </a>
                <a href="{{ route('contact.index') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('contact.*') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
                    Contact Us
                </a>

                <!-- Mobile User Menu -->
                @auth
                    <div class="border-t border-gray-200 pt-4 pb-3">
                        <div class="flex items-center px-4">
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
                            <div class="ml-3">
                                <div class="text-base font-medium text-gray-800">{{ auth()->user()->first_name }}
                                    {{ auth()->user()->last_name }}</div>
                                <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            @if (auth()->user()->role === 'customer' || auth()->user()->role === 'provider')
                                <a href="{{ route('profile.show') }}"
                                    class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                                    Profile</a>
                            @elseif(auth()->user()->role === 'admin' || auth()->user()->role === 'super_admin')
                                <a href="{{ route('dashboard.home') }}"
                                    class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                                    Admin Dashboard</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="border-t border-gray-200 pt-4 pb-3 space-y-1">
                        <a href="{{ route('login') }}"
                            class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                            Log in
                        </a>
                        <a href="{{ route('register') }}"
                            class="block px-4 py-2 text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-md mx-4">
                            Register
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>
<script>
    // Add your JavaScript here for any interactive elements
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileMenuButton = document.querySelector('#mobile-menu-button');
        const mobileMenu = document.querySelector('#mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                if (mobileMenu.style.display === 'none') {
                    mobileMenu.style.display = 'block';
                } else {
                    mobileMenu.style.display = 'none';
                }
            });
        }
    });
</script>

{{-- <link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
@vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="//unpkg.com/alpinejs" defer></script>
<style>
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #8B5CF6;
        border-radius: 2em;
    }

    ::-webkit-scrollbar-track {
        background-color: white;
        margin-block: .1rem;
    }
</style>
<header class="bg-white py-4 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img class="h-10 w-10 " src="{{ asset('images/home_logo.jpg') }}" alt="logo">

                    <span class="ml-3 text-xl font-bold text-indigo-600">Trusty <span
                            class="text-purple-500">Hands</span></span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-10">
                <a href="{{ route('home') }}" class="text-base font-medium text-gray-900">Home</a>
                <a href="{{ route('services.index') }}"
                    class="text-base font-medium text-gray-500 hover:text-gray-900">Services</a>
                <a href="{{ route('aboutUs') }}" class="text-base font-medium text-gray-500 hover:text-gray-900">About
                    Us</a>
                <a href="{{ route('contact.index') }}"
                    class="text-base font-medium text-gray-500 hover:text-gray-900">Contact Us
                </a>
            </nav>

            <!-- User Menu -->
            <div class="flex items-center">
                <!-- User Menu -->
                <div class="flex items-center">
                    @auth
                        <div class="ml-3 relative" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" type="button"
                                    class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
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
                                </button>
                            </div>

                            <!-- Dropdown menu, show/hide based on menu state -->
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                                style="z-index: 100">

                                <!-- User Info -->
                                <div class="block px-4 py-2 text-xs text-gray-500 border-b border-gray-100">
                                    <div class="font-medium text-gray-900">{{ auth()->user()->first_name }}
                                        {{ auth()->user()->last_name }}</div>
                                    <div class="text-xs text-gray-500 mt-0.5">{{ auth()->user()->email }}</div>
                                </div>

                                <!-- Dashboard Link -->
                                @if (auth()->user()->role === 'customer' || auth()->user()->role === 'provider')
                                    <a href="{{ route('profile.show') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Profile</a>
                                @elseif(auth()->user()->role === 'admin' || auth()->user()->role === 'super_admin')
                                    <a href="{{ route('dashboard.home') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Admin Dashboard</a>
                                @endif


                                <!-- Logout -->
                                <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-100">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">
                                        Log Out
                                    </button>
                                </form>
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
<script>
    // Add your JavaScript here for any interactive elements
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileMenuButton = document.querySelector('#mobile-menu-button');
        const mobileMenu = document.querySelector('#mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script> --}}
