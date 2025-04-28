<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Profile - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        .tab-button {
            padding: 0.75rem 1rem;
            font-weight: 500;
            border-bottom: 2px solid transparent;
            transition: all 0.3s;
        }

        .tab-button.active {
            color: #8B5CF6;
            border-bottom-color: #8B5CF6;
        }

        .tab-button:hover:not(.active) {
            color: #6D28D9;
            border-bottom-color: #E0E7FF;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            font-weight: 500;
            color: white;
            background-color: #8B5CF6;
            border-radius: 0.375rem;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: #7C3AED;
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            font-weight: 500;
            color: #6B7280;
            background-color: white;
            border: 1px solid #D1D5DB;
            border-radius: 0.375rem;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            color: #374151;
            border-color: #9CA3AF;
        }

        .btn-danger {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            font-weight: 500;
            color: white;
            background-color: #EF4444;
            border-radius: 0.375rem;
            transition: background-color 0.2s;
        }

        .btn-danger:hover {
            background-color: #DC2626;
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
                    <a href="{{ route('services.index') }}"
                        class="text-base font-medium text-gray-500 hover:text-gray-900">Services</a>
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

    <!-- Profile Content Section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">My Profile</h1>
                <p class="mt-1 text-sm text-gray-600">Manage your account settings and profile information.</p>
            </div>

            <!-- Status Messages -->
            @if (session('status') === 'profile-updated')
                <div class="mb-6 p-4 bg-green-50 rounded-md border border-green-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                Profile updated successfully.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('status') === 'password-updated')
                <div class="mb-6 p-4 bg-green-50 rounded-md border border-green-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                Password updated successfully.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Profile Tabs -->
            <div class="bg-white shadow rounded-lg">
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px">
                        <a href="#profile-info" class="tab-button active" data-tab="profile-info">
                            Profile Information
                        </a>
                        <a href="#password" class="tab-button" data-tab="password">
                            Update Password
                        </a>
                        @if (auth()->user()->role === 'provider')
                            <a href="#provider-settings" class="tab-button" data-tab="provider-settings">
                                Provider Settings
                            </a>
                        @endif
                        <a href="#delete-account" class="tab-button" data-tab="delete-account">
                            Delete Account
                        </a>
                    </nav>
                </div>

                <div class="p-6">
                    <!-- Profile Information Section -->
                    <div id="profile-info" class="tab-content">
                        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                            class="space-y-6">
                            @csrf
                            @method('patch')

                            <div class="flex items-center space-x-6">
                                <div class="flex-shrink-0">
                                    @if ($user->image)
                                        <img class="h-24 w-24 rounded-full object-cover"
                                            src="{{ asset('storage/' . $user->image) }}" alt="Profile">
                                    @else
                                        <div
                                            class="h-24 w-24 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-2xl font-medium text-gray-600">
                                                {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-700">Profile
                                        Photo</label>
                                    <input type="file" id="image" name="image" accept="image/*"
                                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                    <p class="mt-1 text-sm text-gray-500">JPG, PNG or GIF up to 2MB</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700">First
                                        Name</label>
                                    <input type="text" id="first_name" name="first_name"
                                        value="{{ old('first_name', $user->first_name) }}" required autofocus
                                        autocomplete="first_name"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('first_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last
                                        Name</label>
                                    <input type="text" id="last_name" name="last_name"
                                        value="{{ old('last_name', $user->last_name) }}" required
                                        autocomplete="last_name"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('last_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email"
                                        class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" id="email" name="email"
                                        value="{{ old('email', $user->email) }}" required autocomplete="email"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone
                                        Number</label>
                                    <input type="tel" id="phone" name="phone"
                                        value="{{ old('phone', $user->phone) }}" autocomplete="tel"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="address"
                                        class="block text-sm font-medium text-gray-700">Address</label>
                                    <input type="text" id="address" name="address"
                                        value="{{ old('address', $user->address) }}" autocomplete="street-address"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('address')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>

                    <!-- Update Password Section -->
                    <div id="password" class="tab-content hidden">
                        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700">Current
                                    Password</label>
                                <input type="password" id="current_password" name="current_password"
                                    autocomplete="current-password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('current_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">New
                                    Password</label>
                                <input type="password" id="password" name="password" autocomplete="new-password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    autocomplete="new-password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('password_confirmation')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="btn-primary">Update Password</button>
                            </div>
                        </form>
                    </div>

                    <!-- Provider Settings Section -->
                    @if (auth()->user()->role === 'provider')
                        <div id="provider-settings" class="tab-content hidden">
                            <form method="post" action="{{ route('account.provider.profile.update') }}"
                                class="space-y-6">
                                @csrf
                                @method('put')

                                <div>
                                    <label for="service_id" class="block text-sm font-medium text-gray-700">Service
                                        Category</label>
                                    <select id="service_id" name="service_id"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @foreach (App\Models\Service::all() as $service)
                                            <option value="{{ $service->id }}"
                                                {{ $user->provider && $user->provider->service_id == $service->id ? 'selected' : '' }}>
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('service_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700">Service
                                        Description</label>
                                    <textarea id="description" name="description" rows="4"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $user->provider ? $user->provider->description : '' }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="btn-primary">Update Provider Settings</button>
                                </div>
                            </form>
                        </div>
                    @endif

                    <!-- Delete Account Section -->
                    <div id="delete-account" class="tab-content hidden">
                        <div class="max-w-xl">
                            <p class="text-sm text-gray-600">
                                Once your account is deleted, all of its resources and data will be permanently deleted.
                                Before deleting your account, please download any data or information that you wish to
                                retain.
                            </p>

                            <form method="post" action="{{ route('profile.destroy') }}" class="mt-6">
                                @csrf
                                @method('delete')

                                <div>
                                    <label for="password"
                                        class="block text-sm font-medium text-gray-700">Password</label>
                                    <input id="password" name="password" type="password"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="Enter your password to confirm">
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <button type="submit" class="btn-danger">Delete Account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Bookings Section -->
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">My Bookings</h2>

                @if (count(auth()->user()->bookings) > 0)
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Service</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Provider</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach (auth()->user()->bookings()->latest()->take(5)->get() as $booking)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $booking->service->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $booking->provider->user->first_name }}
                                                    {{ $booking->provider->user->last_name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $booking->booking_date->format('M d, Y') }}</div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $booking->booking_date->format('h:i A') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $booking->status === 'confirmed'
                                                        ? 'bg-green-100 text-green-800'
                                                        : ($booking->status === 'completed'
                                                            ? 'bg-blue-100 text-blue-800'
                                                            : ($booking->status === 'cancelled'
                                                                ? 'bg-red-100 text-red-800'
                                                                : 'bg-yellow-100 text-yellow-800')) }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('account.bookings') }}"
                                                    class="text-indigo-600 hover:text-indigo-900">Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <a href="{{ route('account.bookings') }}"
                            class="text-indigo-600 hover:text-indigo-800 font-medium">View All Bookings →</a>
                    </div>
                @else
                    <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                        <p class="text-gray-500">You don't have any bookings yet.</p>
                        <a href="{{ route('services.index') }}" class="mt-4 inline-block btn-primary">Browse
                            Services</a>
                    </div>
                @endif
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab functionality
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Get the tab to activate
                    const tabId = this.getAttribute('data-tab');

                    // Remove active class from all buttons and hide all contents
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.add('hidden'));

                    // Add active class to current button and show current content
                    this.classList.add('active');
                    document.getElementById(tabId).classList.remove('hidden');

                    // Update URL hash
                    window.location.hash = tabId;
                });
            });

            // Check URL hash on page load
            const hash = window.location.hash.substring(1);
            if (hash && document.getElementById(hash)) {
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.add('hidden'));

                document.querySelector(`[data-tab="${hash}"]`).classList.add('active');
                document.getElementById(hash).classList.remove('hidden');
            }

            // Image preview for file upload
            const imageInput = document.getElementById('image');
            if (imageInput) {
                imageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        const preview = document.querySelector('.h-24.w-24'); // The profile image container

                        reader.onload = function(e) {
                            // Create new image element
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('h-24', 'w-24', 'rounded-full', 'object-cover');
                            img.alt = 'Profile';

                            // Replace existing preview with new image
                            preview.innerHTML = '';
                            preview.appendChild(img);
                        }

                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
</body>

</html>
