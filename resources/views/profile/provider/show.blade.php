<x-header />
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">My Provider Profile</h2>
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
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Provider
                                </span>
                            </div>
                        </div>
                        <div class="ml-auto mt-4 md:mt-0 flex flex-col items-center md:items-end">
                            <div class="text-center md:text-right">
                                <p class="text-sm text-gray-500">Member since</p>
                                <p class="text-gray-800 font-medium">{{ $user->created_at->format('M d, Y') }}</p>
                            </div>
                            <div class="mt-3 text-center md:text-right">
                                <p class="text-sm text-gray-500">Completed bookings</p>
                                <p class="text-xl font-bold text-green-600">{{ $completedBookings }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Information -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Business Information</h3>
                    <div class="bg-white border border-gray-200 rounded-lg p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Business Name</p>
                            <p class="text-gray-700 font-medium">{{ $provider->business_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Service Category</p>
                            <p class="text-gray-700 font-medium">{{ $provider->service->name }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">Description</p>
                            <p class="text-gray-700">{{ $provider->description ?: 'No description provided' }}</p>
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
                                            Customer</th>
                                        {{-- <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Service</th> --}}
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $booking->user->first_name }}
                                                    {{ $booking->user->last_name }}</div>
                                                <div class="text-sm text-gray-500">{{ $booking->user->email }}
                                                </div>
                                            </td>
                                            {{-- <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $booking->service->name }}
                                                </div>
                                            </td> --}}
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('h:i A') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($booking->status == 'pending')
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Pending
                                                    </span>
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
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <div class="flex space-x-2">
                                                    @if ($booking->status == 'pending')
                                                        <form method="POST"
                                                            action="{{ route('bookings.update-status', $booking->id) }}">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="confirmed">
                                                            <button type="submit"
                                                                class="text-blue-600 hover:text-blue-900">Confirm</button>
                                                        </form>
                                                        <form method="POST"
                                                            action="{{ route('bookings.update-status', $booking->id) }}">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="cancelled">
                                                            <button type="submit"
                                                                class="text-red-600 hover:text-red-900">Cancel</button>
                                                        </form>
                                                    @elseif($booking->status == 'confirmed')
                                                        <form method="POST"
                                                            action="{{ route('bookings.update-status', $booking->id) }}">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="completed">
                                                            <button type="submit"
                                                                class="text-green-600 hover:text-green-900">Mark
                                                                Complete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="p-6 text-center text-gray-500">
                                You don't have any bookings yet.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-footer />
