<x-dashboard-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Edit User: {{ $user->first_name }}
                    {{ $user->last_name }}
                </h1>
                <a href="{{ route('dashboard.users.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Back to Users
                </a>
            </div>

            <div class="mt-6 bg-white rounded-lg shadow-sm p-6">
                <form action="{{ route('dashboard.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('dashboard.users.form-fields')

                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
