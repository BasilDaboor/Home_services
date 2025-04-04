<x-dashboard-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Services Management') }}
            </h2>
            <a href="{{ route('dashboard.services.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Service
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 text-left">ID</th>
                                    <th class="py-3 px-4 text-left">Name</th>
                                    <th class="py-3 px-4 text-left">Price</th>
                                    <th class="py-3 px-4 text-left">Created At</th>
                                    <th class="py-3 px-4 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($services as $service)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-3 px-4">{{ $service->id }}</td>
                                        <td class="py-3 px-4">{{ $service->name }}</td>
                                        <td class="py-3 px-4">${{ number_format($service->price, 2) }}</td>
                                        <td class="py-3 px-4">{{ $service->created_at->format('M d, Y') }}</td>
                                        <td class="py-3 px-4 flex space-x-2">
                                            <a href="{{ route('dashboard.services.show', $service) }}" class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-1 px-2 rounded">
                                                View
                                            </a>
                                            <a href="{{ route('dashboard.services.edit', $service) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white text-sm font-bold py-1 px-2 rounded">
                                                Edit
                                            </a>
                                            <form action="{{ route('dashboard.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-1 px-2 rounded">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-3 px-4 text-center">No services found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>