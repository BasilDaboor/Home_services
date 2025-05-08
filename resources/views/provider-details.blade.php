<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $provider->service->name }} - {{ $provider->user->first_name }} {{ $provider->user->last_name }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        .provider-header {
            background-color: #fff;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 9999px;
            background-color: #F3E8FF;
            color: #8B5CF6;
        }

        .book-btn {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            font-weight: 600;
            text-align: center;
            background-color: #8B5CF6;
            color: white;
            border-radius: 0.375rem;
            transition: background-color 0.2s;
        }

        .book-btn:hover {
            background-color: #7C3AED;
        }
    </style>
</head>

<body class="antialiased bg-gray-50">
    <!-- Header/Navigation -->

    <x-header />

    <!-- Provider Details Content -->
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content -->
                <div class="w-full lg:w-3/4">
                    <!-- Provider Header -->
                    <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-sm overflow-hidden">
                        <!-- Provider Image -->
                        <div class="md:w-64 h-64 md:h-auto flex-shrink-0 bg-pink-100 flex items-center justify-center">
                            @if ($provider->user->image)
                                <img src="{{ asset('storage/' . $provider->user->image) }}"
                                    alt="{{ $provider->user->first_name }}" class="w-full h-full object-cover">
                            @else
                                <div class="bg-pink-100 flex items-center justify-center w-full h-full">
                                    <img src="{{ asset('images/service-providers/' . strtolower($provider->service->name) . '1.jpg') }}"
                                        alt="{{ $provider->user->first_name }}" class="w-full h-full object-cover">
                                </div>
                            @endif
                        </div>

                        <!-- Provider Info -->
                        <div class="p-6 flex flex-col">
                            <div class="mb-3">
                                <span class="badge">{{ $provider->service->name }}</span>
                            </div>

                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $provider->service->name }}</h1>

                            <div class="flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span
                                    class="text-gray-600">{{ $provider->user->address ?: 'Address not provided' }}</span>
                            </div>

                            <div class="flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="text-gray-600">{{ $provider->user->email }}</span>
                            </div>

                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-gray-600">Available 8:00 AM to 10:PM</span>
                            </div>
                        </div>

                        <!-- Share Button (Desktop) -->

                        <div class="hidden md:flex items-start p-6 relative">
                            <button id="copyButton"
                                class="p-3 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Notification div (positioned outside the container to avoid clipping) -->
                        <div id="copyNotification"
                            style="display: none; position: fixed; padding: 8px 12px; background-color: #6B7280; color: white; font-size: 14px; border-radius: 6px; z-index: 1000; box-shadow: 0 2px 4px rgba(0,0,0,0.2); width: auto; text-align: center; min-width: 100px;">
                            Link copied!
                        </div>

                    </div>

                    <!-- Provider Description -->
                    <div class="mt-8 bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Description</h2>
                        <div class="prose max-w-none text-gray-600">
                            <p>{{ $provider->description ?: 'Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Customer Reviews -->
                    <div class="mt-8 bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Customer Reviews</h2>

                        @forelse($reviews as $review)
                            <div class="border-b border-gray-200 py-4 last:border-b-0 last:pb-0">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        @if ($review->user->image)
                                            <img src="{{ asset('storage/' . $review->user->image) }}"
                                                alt="{{ $review->user->first_name }}" class="h-10 w-10 rounded-full">
                                        @else
                                            <div
                                                class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                <span class="text-sm font-medium text-indigo-600">
                                                    {{ substr($review->user->first_name, 0, 1) }}{{ substr($review->user->last_name, 0, 1) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $review->user->first_name }}
                                            {{ $review->user->last_name }}</p>
                                        <div class="flex items-center mt-1">
                                            <div class="flex items-center">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review->rating)
                                                        <svg class="h-4 w-4 text-yellow-400" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @else
                                                        <svg class="h-4 w-4 text-gray-300" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span
                                                class="ml-2 text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</span>
                                        </div>
                                        @if ($review->comment)
                                            <p class="mt-2 text-sm text-gray-600">{{ $review->comment }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="py-4 text-center">
                                <p class="text-gray-500">No reviews yet for this provider.</p>
                            </div>
                        @endforelse

                        <!-- Pagination -->
                        @if ($reviews->hasPages())
                            <div class="mt-6">
                                {{ $reviews->links() }}
                            </div>
                        @endif
                    </div>

                    <!-- Similar Businesses -->
                    <div class="mt-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Similar Business</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach (App\Models\Provider::whereHas('service', function ($query) use ($provider) {
        $query->where('name', $provider->service->name);
    })->where('id', '!=', $provider->id)->with(['user', 'service'])->take(3)->get() as $similarProvider)
                                <x-provider-card :provider="$similarProvider" />
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Sidebar Booking Form -->
                <div class="w-full lg:w-1/4">
                    <div class="bg-white p-6 rounded-lg shadow-sm sticky top-6">
                        @auth
                            @if (auth()->user()->role === 'customer')
                                <form action="{{ route('bookings.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="provider_id" value="{{ $provider->id }}">
                                    <input type="hidden" name="service_id" value="{{ $provider->service_id }}">

                                    <div class="mb-6">
                                        <label for="booking_date"
                                            class="block text-sm font-medium text-gray-700 mb-1">Select Date and
                                            Time</label>
                                        <input type="datetime-local" name="booking_date" id="booking_date" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>

                                    <div class="mb-6">
                                        <label for="notes"
                                            class="block text-sm font-medium text-gray-700 mb-1">Additional Notes</label>
                                        <textarea name="notes" id="notes" rows="3"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                                    </div>

                                    <button type="submit" class="book-btn flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Book Appointment
                                    </button>
                                </form>
                            @else
                                <div class="text-center py-4">
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Provider Account</h3>
                                    <p class="text-gray-600 mb-6">You are logged in as a provider. To book services, please
                                        register as a customer.</p>
                                    <a href="{{ route('register') }}" class="book-btn block">Register as Customer</a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-4">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Login to Book</h3>
                                <p class="text-gray-600 mb-6">Please login or create an account to book this service.</p>
                                <a href="{{ route('login') }}" class="book-btn block mb-4">Login</a>
                                <a href="{{ route('register') }}"
                                    class="block text-center w-full px-4 py-2 border border-indigo-600 rounded-md text-indigo-600 font-medium">Register</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />


    <script>
        // Simple date validation for booking form
        document.addEventListener('DOMContentLoaded', function() {
            const bookingDateInput = document.getElementById('booking_date');

            if (bookingDateInput) {
                // Set min date to today
                const today = new Date();
                const year = today.getFullYear();
                const month = String(today.getMonth() + 1).padStart(2, '0');
                const day = String(today.getDate()).padStart(2, '0');
                const hours = String(today.getHours()).padStart(2, '0');
                const minutes = String(today.getMinutes()).padStart(2, '0');

                bookingDateInput.min = `${year}-${month}-${day}T${hours}:${minutes}`;

                // Add max date (e.g., 3 months from now)
                const maxDate = new Date();
                maxDate.setMonth(maxDate.getMonth() + 3);
                const maxYear = maxDate.getFullYear();
                const maxMonth = String(maxDate.getMonth() + 1).padStart(2, '0');
                const maxDay = String(maxDate.getDate()).padStart(2, '0');

                bookingDateInput.max = `${maxYear}-${maxMonth}-${maxDay}T23:59`;
            }
        });



        const button = document.getElementById('copyButton');
        const notification = document.getElementById('copyNotification');

        button.addEventListener('click', (e) => {
            // Copy the URL
            navigator.clipboard.writeText(window.location.href)
                .then(() => {
                    // Get button position
                    const buttonRect = button.getBoundingClientRect();

                    // Position notification under the button (centered)
                    const notificationWidth = 100; // Approximate width, adjust if needed
                    notification.style.left = (buttonRect.left + (buttonRect.width / 2) - (notificationWidth /
                        2)) + 'px';
                    notification.style.top = (buttonRect.bottom + 10) + 'px'; // 10px below the button

                    // Make sure the notification is visible
                    notification.style.display = 'block';
                    notification.style.opacity = '1';
                    notification.style.zIndex = '1000';

                    // Hide it after 1.5 seconds
                    setTimeout(() => {
                        notification.style.display = 'none';
                    }, 1500);
                })
                .catch(err => {
                    console.error('Failed to copy: ', err);
                });
        });;
    </script>
</body>

</html>
