<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
        <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name ?? '') }}"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        @error('first_name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
        <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name ?? '') }}"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        @error('last_name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="phone" class="block text-sm font-medium text-gray-700">Phone (Optional)</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone ?? '') }}"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        @error('phone')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="sm:col-span-2">
        <label for="address" class="block text-sm font-medium text-gray-700">Address (Optional)</label>
        <input type="text" name="address" id="address" value="{{ old('address', $user->address ?? '') }}"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        @error('address')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">
            {{ isset($user) ? 'Password (Leave blank to keep current)' : 'Password' }}
        </label>
        <input type="password" name="password" id="password"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
    </div>

    <div class="sm:col-span-2">
        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
        <select name="role" id="role"
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            onchange="toggleProviderFields()">
            <option value="customer" {{ old('role', $user->role ?? '') == 'customer' ? 'selected' : '' }}>Customer
            </option>
            <option value="provider" {{ old('role', $user->role ?? '') == 'provider' ? 'selected' : '' }}>Provider
            </option>
            <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="super_admin" {{ old('role', $user->role ?? '') == 'super_admin' ? 'selected' : '' }}>Super
                Admin</option>
        </select>
        @error('role')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Provider specific fields -->
    <div id="provider-fields" class="sm:col-span-2 grid grid-cols-1 gap-6 sm:grid-cols-2" style="display: none;">
        <div>
            <label for="service_id" class="block text-sm font-medium text-gray-700">Service</label>
            <select name="service_id" id="service_id"
                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Select a service</option>
                @isset($services)
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}"
                            {{ old('service_id', isset($user) && $user->provider ? $user->provider->service_id : '') == $service->id ? 'selected' : '' }}>
                            {{ $service->name }}
                        </option>
                    @endforeach
                @endisset
            </select>
            @error('service_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="sm:col-span-2">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="3"
                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description', isset($user) && $user->provider ? $user->provider->description : '') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Image upload field -->
    <div class="sm:col-span-2">
        <label for="image" class="block text-sm font-medium text-gray-700">Profile Image</label>
        <div class="mt-1 flex items-center">
            @if (isset($user) && $user->image)
                <img src="{{ asset('storage/' . $user->image) }}" alt="Current image"
                    class="h-20 w-20 rounded-full object-cover mr-4">
            @endif
            <input type="file" name="image" id="image" accept="image/*"
                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300">
        </div>
        @error('image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<script>
    function toggleProviderFields() {
        var role = document.getElementById('role').value;
        var providerFields = document.getElementById('provider-fields');

        if (role === 'provider') {
            providerFields.style.display = 'grid';
        } else {
            providerFields.style.display = 'none';
        }
    }

    // Run on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleProviderFields();
    });
</script>
