<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Provider;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('first_name', 'like', "%{$searchTerm}%")
                    ->orWhere('last_name', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%");
            });
        }

        // Filter by role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('dashboard.users.create', compact('services'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role' => ['required', Rule::in(['customer', 'provider', 'admin', 'super_admin'])],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // Add provider-specific rules only if role is provider
        if ($request->role === 'provider') {
            $rules['service_id'] = 'required|exists:services,id';
            $rules['description'] = 'nullable|string';
        }

        $validated = $request->validate($rules);

        DB::beginTransaction();
        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('user-images', 'public');
                $validated['image'] = $imagePath;
            }

            $validated['password'] = Hash::make($validated['password']);

            // Create the user
            $user = User::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
                'role' => $validated['role'],
                'image' => $validated['image'] ?? null,
            ]);

            // If role is provider, create provider record
            if ($validated['role'] === 'provider') {
                Provider::create([
                    'user_id' => $user->id,
                    'service_id' => $validated['service_id'],
                    'description' => $validated['description'] ?? null,
                    'rating' => 0,
                ]);
            }

            DB::commit();

            return redirect()->route('dashboard.users.index')
                ->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating user: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if ($user->role === 'provider') {
            $user->load('provider.service');
        }
        return view('dashboard.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $services = Service::all();
        return view('dashboard.users.edit', compact('user', 'services'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role' => ['required', Rule::in(['customer', 'provider', 'admin', 'super_admin'])],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // Add provider-specific rules only if role is provider
        if ($request->role === 'provider') {
            $rules['service_id'] = 'required|exists:services,id';
            $rules['description'] = 'nullable|string';
        }

        $validated = $request->validate($rules);
        DB::beginTransaction();
        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                // if ($user->image) {
                //     \Storage::disk('public')->delete($user->image);
                // }
                $imagePath = $request->file('image')->store('user-images', 'public');
                $validated['image'] = $imagePath;
            }

            // Only update password if provided
            if (!empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            // Update user data
            $user->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
                'role' => $validated['role'],
                'image' => $validated['image'] ?? $user->image,
            ] + (isset($validated['password']) ? ['password' => $validated['password']] : []));

            // Handle provider relationship
            if ($validated['role'] === 'provider') {
                // Create or update provider record
                $user->provider()->updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'service_id' => $validated['service_id'],
                        'description' => $validated['description'] ?? null,
                    ]
                );
            } else {
                // If role changed from provider to something else, delete provider record
                if ($user->provider) {
                    $user->provider->delete();
                }
            }

            DB::commit();

            return redirect()->route('dashboard.users.index')
                ->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating user: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === Auth::id()) {
            return redirect()->route('dashboard.users.index')
                ->with('error', 'You cannot delete your own account.');
        }
        if ($user->provider) {
            $user->provider->delete();
        }
        // Delete user image if exists
        // if ($user->image) {
        //     \Storage::disk('public')->delete($user->image);
        // }

        $user->delete();

        return redirect()->route('dashboard.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
