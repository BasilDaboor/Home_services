<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
@vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="//unpkg.com/alpinejs" defer></script>

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
                <a href="{{ route('home') }}" class="text-base font-medium text-gray-900">Home</a>
                <a href="{{ route('services.index') }}"
                    class="text-base font-medium text-gray-500 hover:text-gray-900">Services</a>
                <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">About Us</a>
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
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                tabindex="-1">

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





                                <!-- Bookings Link -->


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
</script>
