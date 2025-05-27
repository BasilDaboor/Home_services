<footer class="bg-white mt-12">
    <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo and Description -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img class="h-12 w-12 " src="{{ asset('images/home_logo.jpg') }}" alt="logo">

                        <span class="ml-3 text-xl font-bold text-indigo-600">Trusty <span
                                class="text-purple-500">Hands</span></span>
                    </a>
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
                    <li><a href="{{ route('home') }}" class="text-base text-gray-500 hover:text-gray-900">Home</a></li>
                    <li><a href="{{ route('services.index') }}"
                            class="text-base text-gray-500 hover:text-gray-900">Services</a></li>
                    <li><a href="{{ route('aboutUs') }}" class="text-base text-gray-500 hover:text-gray-900">About
                            Us</a></li>
                    <li><a href="{{ route('contact.index') }}"
                            class="text-base text-gray-500 hover:text-gray-900">Contact</a></li>
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
                        <span class="text-gray-500">+(962) 781 538 135</span>
                    </li>
                    <li class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="text-gray-500">Trustyhands@gmail.com</span>
                    </li>
                    <li class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-gray-500">Al-Dakhliya Cir,Amman,Jordan</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-12 border-t border-gray-200 pt-8">
            <p class="text-base text-gray-400 text-center">
                &copy; {{ date('Y') }} Trusty Hands. All rights reserved.
            </p>
        </div>
    </div>
</footer>
