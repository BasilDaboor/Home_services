<x-header />

<div class="bg-white">
    <!-- Hero Section with Image -->
    <div class="relative overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('images/home_hero.jpg') }}" alt="Home Services" class="w-full h-full object-cover"
                style="opacity: 80%">
            <div class="absolute inset-0 bg-gray-900 opacity-70"></div>
        </div>
        <div
            class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 text-center md:text-left">
                <h1 class="text-4xl font-extrabold tracking-tight text-indigo-600 sm:text-5xl lg:text-6xl mt-5">
                    Trusty <span class="text-purple-500">Hands</span>
                </h1>
                <p class="mt-6 text-xl text-gray-100 max-w-xl font-medium">
                    We connect homeowners with trusted professionals for all your home service needs. From plumbing to
                    cleaning, electrical work to landscaping - quality service is just a click away.
                </p>
                <div class="mt-12 flex flex-col sm:flex-row gap-4 justify-start md:justify-start">
                    <a href="{{ route('contact.index') }}"
                        class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-purple-700 bg-white hover:bg-gray-50 shadow-md">
                        Become a Provider
                    </a>
                    <a href="{{ route('services.index') }}"
                        class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 shadow-md">
                        Find a Service
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section (Improved Design) -->
    <div class="bg-gray-50 py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">How Trusty Hands Works</h2>
                <p class="mt-4 text-lg text-gray-500 max-w-2xl mx-auto">
                    A seamless experience for both customers and service providers.
                </p>
            </div>

            <div class="mt-16">
                <!-- Customer Experience -->
                <div class="relative">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-3 bg-gray-50 text-lg font-medium text-purple-600">For Customers</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-8 md:grid-cols-3">
                    <!-- Step 1 -->
                    <div class="relative">
                        <div
                            class="flex items-center justify-center h-16 w-16 rounded-full bg-purple-100 text-purple-600 mx-auto mb-4">
                            <span class="text-2xl font-bold">1</span>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900 text-center">Browse Services</h3>
                        <p class="mt-3 text-base text-gray-500 text-center">
                            Explore our wide range of home services and find exactly what you need.
                        </p>
                        <div class="absolute top-8 left-1/2 transform -translate-x-1/2 mt-8 hidden md:block">
                            <svg class="h-8 w-24 text-purple-300" viewBox="0 0 80 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 5H70" stroke="currentColor" stroke-width="2" stroke-dasharray="2 2" />
                                <path d="M70 5L65 1" stroke="currentColor" stroke-width="2" />
                                <path d="M70 5L65 9" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative">
                        <div
                            class="flex items-center justify-center h-16 w-16 rounded-full bg-purple-100 text-purple-600 mx-auto mb-4">
                            <span class="text-2xl font-bold">2</span>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900 text-center">Book a Provider</h3>
                        <p class="mt-3 text-base text-gray-500 text-center">
                            Select from our vetted professionals based on availability, ratings, and reviews.
                        </p>
                        <div class="absolute top-8 left-1/2 transform -translate-x-1/2 mt-8 hidden md:block">
                            <svg class="h-8 w-24 text-purple-300" viewBox="0 0 80 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 5H70" stroke="currentColor" stroke-width="2" stroke-dasharray="2 2" />
                                <path d="M70 5L65 1" stroke="currentColor" stroke-width="2" />
                                <path d="M70 5L65 9" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div>
                        <div
                            class="flex items-center justify-center h-16 w-16 rounded-full bg-purple-100 text-purple-600 mx-auto mb-4">
                            <span class="text-2xl font-bold">3</span>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900 text-center">Enjoy & Review</h3>
                        <p class="mt-3 text-base text-gray-500 text-center">
                            Sit back while experts take care of your home. Then share your experience.
                        </p>
                    </div>
                </div>

                <!-- Provider Experience -->
                <div class="relative mt-16">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-3 bg-gray-50 text-lg font-medium text-purple-600">For Service Providers</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-8 md:grid-cols-3">
                    <!-- Step 1 -->
                    <div class="relative">
                        <div
                            class="flex items-center justify-center h-16 w-16 rounded-full bg-purple-100 text-purple-600 mx-auto mb-4">
                            <span class="text-2xl font-bold">1</span>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900 text-center">Apply to Join</h3>
                        <p class="mt-3 text-base text-gray-500 text-center">
                            Complete our application process and verification checks to join our trusted network.
                        </p>
                        <div class="absolute top-8 left-1/2 transform -translate-x-1/2 mt-8 hidden md:block">
                            <svg class="h-8 w-24 text-purple-300" viewBox="0 0 80 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 5H70" stroke="currentColor" stroke-width="2" stroke-dasharray="2 2" />
                                <path d="M70 5L65 1" stroke="currentColor" stroke-width="2" />
                                <path d="M70 5L65 9" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative">
                        <div
                            class="flex items-center justify-center h-16 w-16 rounded-full bg-purple-100 text-purple-600 mx-auto mb-4">
                            <span class="text-2xl font-bold">2</span>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900 text-center">Manage Your Profile</h3>
                        <p class="mt-3 text-base text-gray-500 text-center">
                            Set your availability, pricing, and showcase your expertise to potential clients.
                        </p>
                        <div class="absolute top-8 left-1/2 transform -translate-x-1/2 mt-8 hidden md:block">
                            <svg class="h-8 w-24 text-purple-300" viewBox="0 0 80 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 5H70" stroke="currentColor" stroke-width="2" stroke-dasharray="2 2" />
                                <path d="M70 5L65 1" stroke="currentColor" stroke-width="2" />
                                <path d="M70 5L65 9" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div>
                        <div
                            class="flex items-center justify-center h-16 w-16 rounded-full bg-purple-100 text-purple-600 mx-auto mb-4">
                            <span class="text-2xl font-bold">3</span>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900 text-center">Grow Your Business</h3>
                        <p class="mt-3 text-base text-gray-500 text-center">
                            Accept bookings, deliver quality service, and build your reputation through great reviews.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Values -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Our Values</h2>
            <p class="mt-4 text-lg text-gray-500 max-w-3xl mx-auto">
                The principles that guide everything we do at Trusty Hands.
            </p>
        </div>

        <div class="mt-10 grid gap-10 md:grid-cols-3">
            <div class="flex flex-col items-center">
                <div
                    class="flex items-center justify-center h-16 w-16 rounded-full bg-purple-100 text-purple-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900">Trust</h3>
                <p class="mt-3 text-base text-gray-500 text-center">
                    We thoroughly vet every service provider and stand behind their work with our satisfaction
                    guarantee.
                </p>
            </div>

            <div class="flex flex-col items-center">
                <div
                    class="flex items-center justify-center h-16 w-16 rounded-full bg-purple-100 text-purple-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900">Reliability</h3>
                <p class="mt-3 text-base text-gray-500 text-center">
                    When you book a service, you can count on it being done right and on time. We value your time and
                    deliver on our promises.
                </p>
            </div>

            <div class="flex flex-col items-center">
                <div
                    class="flex items-center justify-center h-16 w-16 rounded-full bg-purple-100 text-purple-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900">Convenience</h3>
                <p class="mt-3 text-base text-gray-500 text-center">
                    We're committed to making home care as simple as possible. From booking to payment, every step is
                    designed to save you time.
                </p>
            </div>
        </div>
    </div>

    <!-- Meet Our Providers Section -->
    <div class="bg-gray-50 py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Meet Our Top Providers</h2>
                <p class="mt-4 text-lg text-gray-500 max-w-3xl mx-auto">
                    Our network of skilled professionals is ready to help with all your home service needs.
                </p>
            </div>

            <div class="mt-12 flex justify-center ">
                <!-- Featured Providers -->
                <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3 ">
                    @foreach ($featuredProviders as $provider)
                        <x-provider-card :provider="$provider" />
                    @endforeach
                </div>

                <div class="mt-12 text-center">
                    {{-- <a href="{{ route('providers.index') }}"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-purple-600 hover:bg-purple-700">
                        View All Providers
                    </a> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Our Story -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:py-32 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Our Story
                </h2>
                <p class="mt-4 text-lg text-gray-500">
                    Trusty Hands was founded by a team of home service professionals and tech experts who saw a gap in
                    the market. Too many homeowners struggled to find reliable help for their homes, while skilled
                    professionals lacked a consistent way to connect with new clients.
                </p>
                <p class="mt-4 text-lg text-gray-500">
                    What started as a small local network has grown into a platform connecting thousands of homeowners
                    with trusted service providers every day. Our team remains dedicated to our original vision: making
                    home care hassle-free for everyone.
                </p>
                <p class="mt-4 text-lg text-gray-500">
                    Today, we're proud to be the preferred platform for both homeowners seeking quality service and
                    professionals looking to grow their businesses.
                </p>
            </div>
            <div class="mt-12 relative text-base max-w-prose mx-auto lg:mt-0">
                <div class="aspect-w-12 aspect-h-7 lg:aspect-none">
                    <div class="rounded-lg shadow-lg overflow-hidden">
                        <img src="{{ asset('images/team_photo.jpg') }}" alt="Our Team"
                            class="w-full h-full object-cover object-center">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Join CTA -->
    <div class="bg-purple-700">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">Ready to transform your home service experience?</span>
                <span class="block text-purple-200">Join Trusty Hands today.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-purple-600 bg-white hover:bg-gray-50">
                        Get Started
                    </a>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="{{ route('services.index') }}"
                        class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-600 hover:bg-purple-500">
                        Browse Services
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<x-footer />
