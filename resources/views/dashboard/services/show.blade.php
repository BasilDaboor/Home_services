<x-dashboard-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Service Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('dashboard.services.edit', $service) }}"
                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('dashboard.services.index') }}"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Service Information</h3>
                        <div class="mt-4 bg-gray-50 p-4 rounded">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">ID</p>
                                    <p class="mt-1">{{ $service->id }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Name</p>
                                    <p class="mt-1">{{ $service->name }}</p>
                                </div>

                            </div>

                            <div class="mt-4">
                                <p class="text-sm font-medium text-gray-500">Description</p>
                                <p class="mt-1">{{ $service->description ?? 'No description provided.' }}</p>
                            </div>

                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Created At</p>
                                    <p class="mt-1">{{ $service->created_at->format('F d, Y H:i A') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Last Updated</p>
                                    <p class="mt-1">{{ $service->updated_at->format('F d, Y H:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Related Information</h3>
                        <div class="mt-4 bg-gray-50 p-4 rounded">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Number of Providers</p>
                                    <p class="mt-1">{{ $service->providers()->count() }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Number of Bookings</p>
                                    <p class="mt-1">{{ $service->bookings()->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-between">
                        <form action="{{ route('dashboard.services.destroy', $service) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this service?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Delete Service
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
