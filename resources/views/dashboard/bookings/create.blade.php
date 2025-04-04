<x-dashboard-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Create New Booking</h2>
            <a href="{{ route('dashboard.bookings.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-md text-white">Back to Bookings</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Oops!</strong>
                                <span class="block sm:inline">Please fix the following errors:</span>
                                <ul class="mt-2 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <!-- Booking Form -->
                    <form action="{{ route('dashboard.bookings.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- User Selection -->
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">User</label>
                                <select name="user_id" id="user_id" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Provider Selection -->
                            <div>
                                <label for="provider_id" class="block text-sm font-medium text-gray-700 mb-1">Provider</label>
                                <select name="provider_id" id="provider_id" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Select Provider</option>
                                    @foreach($providers as $provider)
                                        <option value="{{ $provider->id }}" {{ old('provider_id') == $provider->id ? 'selected' : '' }}>
                                            {{ $provider->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Service Selection -->
                            <div>
                                <label for="service_id" class="block text-sm font-medium text-gray-700 mb-1">Service</label>
                                <select name="service_id" id="service_id" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Select Service</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Booking Date -->
                            <div>
                                <label for="booking_date" class="block text-sm font-medium text-gray-700 mb-1">Booking Date & Time</label>
                                <input type="datetime-local" name="booking_date" id="booking_date" value="{{ old('booking_date') }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Status Selection -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" id="status" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ old('status', 'pending') == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                                Create Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>