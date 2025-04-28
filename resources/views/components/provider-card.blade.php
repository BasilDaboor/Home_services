@props(['provider'])
<div class="bg-white rounded-lg overflow-hidden shadow-md transition-shadow hover:shadow-lg">
    <!-- Provider Image -->
    <div class="h-48 bg-gray-200">
        @if ($provider->user->image)
            <img src="{{ $provider->user->image }}" alt="{{ $provider->user->first_name }}"
                class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
        @endif
    </div>

    <!-- Service Type Badge -->
    <div class="pt-4 px-4">
        <span class="inline-block px-3 py-1 text-xs font-medium text-purple-800 bg-purple-100 rounded-full">
            {{ $provider->service->name }}
        </span>
    </div>

    <!-- Provider Info -->
    <div class="p-4">
        {{-- <h3 class="text-lg font-bold text-gray-900">{{ $provider->service->name }}</h3> --}}
        <p class="text-md text-indigo-600 font-medium">{{ $provider->user->first_name }}
            {{ $provider->user->last_name }}</p>

        @if ($provider->user->address)
            <p class="mt-2 text-sm text-gray-600">
                {{ $provider->user->address }}
            </p>
        @endif

        <a href="{{ route('provider.details', $provider->id) }}"
            class="mt-4 inline-block px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700">
            Book Now
        </a>
    </div>
</div>
