<x-header />
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="mb-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold text-gray-800">Edit Provider Profile</h2>
                        <a href="{{ route('profile.show') }}" class="text-indigo-600 hover:text-indigo-800">
                            &larr; Back to Profile
                        </a>
                    </div>
                    <p class="text-gray-600 mt-1">Update your personal and business information</p>
                </div>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- First Name -->
                        <div>
                            <x-input-label for="first_name" :value="__('First Name')" />
                            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full"
                                :value="old('first_name', $user->first_name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                        </div>

                        <!-- Last Name -->
                        <div>
                            <x-input-label for="last_name" :value="__('Last Name')" />
                            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full"
                                :value="old('last_name', $user->last_name)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                            :value="old('email', $user->email)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <!-- Phone -->
                    <div>
                        <x-input-label for="phone" :value="__('Phone')" />
                        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                            :value="old('phone', $user->phone)" />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>

                    <!-- Address -->
                    <div>
                        <x-input-label for="address" :value="__('Address')" />
                        <textarea id="address" name="address"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            rows="3">{{ old('address', $user->address) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <hr class="my-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Business Information</h3>

                    <!-- Business Name -->
                    <div>
                        <x-input-label for="business_name" :value="__('Business Name')" />
                        <x-text-input id="business_name" name="business_name" type="text" class="mt-1 block w-full"
                            :value="old('business_name', $provider->business_name)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('business_name')" />
                    </div>

                    <!-- Service Category -->
                    {{-- <div>
                        <x-input-label for="service_id" :value="__('Service Category')" />
                        <select id="service_id" name="service_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}"
                                    {{ $provider->service_id == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('service_id')" />
                    </div> --}}

                    <!-- Business Description -->
                    <div>
                        <x-input-label for="description" :value="__('Business Description')" />
                        <textarea id="description" name="description"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            rows="5">{{ old('description', $provider->description) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <!-- Hidden Role Field (to maintain the current role) -->
                    <input type="hidden" name="role" value="{{ $user->role }}" />

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-4">
                            {{ __('Save') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Account Section -->
        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Delete Account</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Once your account is deleted, all of its resources and data will be permanently deleted.
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="bg-white shadow sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="max-w-xl text-sm text-gray-500">
                                <p>
                                    Once your account is deleted, all of its resources and data will be permanently
                                    deleted. Before deleting your account, please download any data or information
                                    that you wish to retain.
                                </p>
                            </div>

                            <div class="mt-5">
                                <button type="button"
                                    class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-700 transition"
                                    onclick="document.getElementById('delete-account-modal').classList.remove('hidden')">
                                    Delete Account
                                </button>
                            </div>

                            <!-- Delete Account Modal -->
                            <div id="delete-account-modal"
                                class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
                                <div class="bg-white rounded-lg p-6 max-w-md w-full">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Confirm Account Deletion</h3>
                                    <p class="text-sm text-gray-500 mb-4">
                                        Are you sure you want to delete your account? Once your account is deleted,
                                        all of its resources and data will be permanently deleted. Please enter your
                                        password to confirm you would like to permanently delete your account.
                                    </p>

                                    <form method="post" action="{{ route('profile.destroy') }}">
                                        @csrf
                                        @method('delete')

                                        <div>
                                            <x-input-label for="password" :value="__('Password')" />
                                            <x-text-input id="password" name="password" type="password"
                                                class="mt-1 block w-full" placeholder="Password" />
                                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                        </div>

                                        <div class="mt-6 flex justify-end">
                                            <button type="button"
                                                class="mr-3 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                onclick="document.getElementById('delete-account-modal').classList.add('hidden')">
                                                Cancel
                                            </button>
                                            <button type="submit"
                                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                Delete Account
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-footer />
