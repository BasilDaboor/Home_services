<x-header />
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">My Profile</h2>
                    <a href="{{ route('profile.edit') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-700 transition">
                        Edit Profile
                    </a>
                </div>

                <!-- Profile Overview -->
                <div class="bg-indigo-50 rounded-lg p-6 mb-6">
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="flex-shrink-0 mb-4 md:mb-0">
                            @if (auth()->user()->image)
                                <img class="h-24 w-24 rounded-full object-cover"
                                    src="{{ asset('storage/' . auth()->user()->image) }}" alt="Profile">
                            @else
                                <div class="h-24 w-24 rounded-full bg-indigo-200 flex items-center justify-center">
                                    <span class="text-2xl font-medium text-indigo-600">
                                        {{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="md:ml-6 text-center md:text-left">
                            <h3 class="text-xl font-bold text-gray-800">{{ $user->first_name }}
                                {{ $user->last_name }}</h3>
                            <p class="text-gray-600">{{ $user->email }}</p>
                            <p class="text-gray-600">{{ $user->phone }}</p>
                            <div class="mt-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                    Customer
                                </span>
                            </div>
                        </div>
                        <div class="ml-auto mt-4 md:mt-0 flex flex-col items-center md:items-end">
                            <div class="text-center md:text-right">
                                <p class="text-sm text-gray-500">Member since</p>
                                <p class="text-gray-800 font-medium">{{ $user->created_at->format('M d, Y') }}</p>
                            </div>
                            <div class="mt-3 text-center md:text-right">
                                <p class="text-sm text-gray-500">Total bookings</p>
                                <p class="text-xl font-bold text-indigo-600">{{ $user->bookings->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Address</h3>
                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-700">{{ $user->address ?: 'No address provided' }}</p>
                    </div>
                </div>

                <!-- Recent Bookings -->
                <div>
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-medium text-gray-900">Recent Bookings</h3>
                        <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">View all</a>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                        @if ($bookings->count() > 0)
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
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $booking->service->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $booking->provider->user->first_name }}
                                                    {{ $booking->provider->user->last_name }}</div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $booking->provider->business_name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ \Carbon\Carbon::parse($booking->BookingDate)->format('M d, Y') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ \Carbon\Carbon::parse($booking->BookingDate)->format('h:i A') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($booking->status == 'pending')
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Pending
                                                    </span>
                                                    <form action="{{ route('bookings.cancel', $booking->id) }}"
                                                        method="POST" class="inline-block ml-2">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-900 text-xs font-semibold"
                                                            onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                            Cancel
                                                        </button>
                                                    </form>
                                                    {{-- add a cancel button her --}}
                                                @elseif($booking->status == 'confirmed')
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        Confirmed
                                                    </span>
                                                @elseif($booking->status == 'completed')
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Completed
                                                    </span>
                                                @elseif($booking->status == 'cancelled')
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Cancelled
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="p-6 text-center text-gray-500">
                                You haven't made any bookings yet.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-footer />
