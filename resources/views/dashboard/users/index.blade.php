<x-dashboard-layout>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-3 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Users Management</h1>
                <a href="{{ route('dashboard.users.create') }}"
                    class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add New User
                </a>
            </div>

            <!-- Search and Filter -->
            <div class="mt-6 bg-white rounded-lg shadow-sm p-4">
                <form action="{{ route('dashboard.users.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow">
                        <label for="search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="Search by name or email">
                        </div>
                    </div>

                    <div class="w-full md:w-64">
                        <label for="role" class="sr-only">Filter by Role</label>
                        <select name="role" id="role"
                            class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">All Roles</option>
                            <option value="customer" {{ request('role') == 'customer' ? 'selected' : '' }}>Customer
                            </option>
                            <option value="provider" {{ request('role') == 'provider' ? 'selected' : '' }}>Provider
                            </option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="super_admin" {{ request('role') == 'super_admin' ? 'selected' : '' }}>Super
                                Admin</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Filter
                        </button>
                        @if (request('search') || request('role'))
                            <a href="{{ route('dashboard.users.index') }}"
                                class="ml-2 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Flash Messages -->
            @if (session('success'))
                <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Users Table -->
            <div class="mt-4 flex flex-col ">
                <div class="-my-2 overflow-x-hidden sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-3 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Role
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Created At
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Action
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($users as $user)
                                        <tr>
                                            <td class="px-3 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <div
                                                            class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                            <span
                                                                class="text-gray-500 font-medium">{{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $user->first_name }} {{ $user->last_name }}
                                                        </div>
                                                        @if ($user->phone)
                                                            <div class="text-sm text-gray-500">
                                                                {{ $user->phone }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-3 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $user->email_verified_at ? 'Verified' : 'Not verified' }}
                                                </div>
                                            </td>
                                            <td class="px-3 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $user->role == 'super_admin'
                                                        ? 'bg-purple-100 text-purple-800'
                                                        : ($user->role == 'admin'
                                                            ? 'bg-indigo-100 text-indigo-800'
                                                            : ($user->role == 'provider'
                                                                ? 'bg-blue-100 text-blue-800'
                                                                : 'bg-green-100 text-green-800')) }}">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $user->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium "
                                                style="display: flex;">
                                                <a href="{{ route('dashboard.users.show', $user) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 mr-3">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <a href="{{ route('dashboard.users.edit', $user) }}"
                                                    class="text-yellow-600 hover:text-yellow-900 mr-3">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                @if ($user->id !== auth()->id())
                                                    <form action="{{ route('dashboard.users.destroy', $user) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900"
                                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5"
                                                class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                No users found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    {{ $users->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
