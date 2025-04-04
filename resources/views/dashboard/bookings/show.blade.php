<x-dashboard-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Booking Details #{{ $booking->id }}</h2>
            <div class="flex space-x-2">
                <a href="{{ route('dashboard.bookings.edit', $booking) }}" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 rounded-md text-white">Edit</a>
                <a href="{{ route('dashboard.bookings.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-md text-white">Back to List</a>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    

                    <div class="bg-gray-50 rounded-lg shadow p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
                            <!-- Booking ID -->
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Booking ID</h3>
                                <p class="mt-1 text-lg font-semibold">{{ $booking->id }}</p>
                            </div>

                            <!-- Status -->
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Status</h3>
                                <p class="mt-1">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                                        @if($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($booking->status == 'confirmed') bg-blue-100 text-blue-800
                                        @elseif($booking->status == 'cancelled') bg-red-100 text-red-800
                                        @elseif($booking->status == 'completed') bg-green-100 text-green-800
                                        @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </p>
                            </div>

                            <!-- Booking Date -->
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Booking Date & Time</h3>
                                <p class="mt-1 text-lg">{{ $booking->booking_date->format('F d, Y - h:i A') }}</p>
                            </div>

                            <!-- Created At -->
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Booking Created</h3>
                                <p class="mt-1">{{ $booking->created_at->format('F d, Y - h:i A') }}</p>
                            </div>

                            <!-- User Info -->
                            <div class="md:col-span-2">
                                <h3 class="text-sm font-medium text-gray-500">User Information</h3>
                                <div class="mt-2 bg-white p-4 rounded-md border">
                                    <p class="font-medium">{{ $booking->user->name }}</p>
                                    <p class="text-gray-600">{{ $booking->user->email }}</p>
                                </div>
                            </div>

                            <!-- Provider Info -->
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Provider</h3>
                                <div class="mt-2 bg-white p-4 rounded-md border">
                                    <p class="font-medium">{{ $booking->provider->name }}</p>
                                </div>
                            </div>

                            <!-- Service Info -->
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Service</h3>
                                <div class="mt-2 bg-white p-4 rounded-md border">
                                    <p class="font-medium">{{ $booking->service->name }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-8 flex space-x-4">
                            <form action="{{ route('dashboard.bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md">
                                    Delete Booking
                                </button>
                            </form>
                            
                            <!-- Quick Status Update Form -->
                            <form action="{{ route('dashboard.bookings.update', $booking) }}" method="POST" class="flex space-x-2">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{ $booking->user_id }}">
                                <input type="hidden" name="provider_id" value="{{ $booking->provider_id }}">
                                <input type="hidden" name="service_id" value="{{ $booking->service_id }}">
                                <input type="hidden" name="booking_date" value="{{ $booking->booking_date->format('Y-m-d\TH:i') }}">
                                
                                <select name="status" class="px-4 py-2 border rounded-md">
                                    @foreach(['pending', 'confirmed', 'cancelled', 'completed'] as $status)
                                        <option value="{{ $status }}" {{ $booking->status == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                                
                                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                                    Update Status
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>