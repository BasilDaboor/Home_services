<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Provider;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show(Request $request): View
    {

        $user = $request->user();
        // dd($user);

        if ($user->role === 'provider') {
            // dd('hi');
            $provider = Provider::where('user_id', $user->id)->with('service')->first();
            $bookings = $user->provider->bookings()->with(['user', 'service'])->latest()->take(5)->get();
            $completedBookings = $user->provider->bookings()->where('status', 'Completed')->count();

            return view('profile.provider.show', [
                'user' => $user,
                'provider' => $provider,
                'bookings' => $bookings,
                'completedBookings' => $completedBookings,
            ]);
        }

        // For regular users (customers)
        $bookings = $user->bookings()->with(['provider.user', 'service'])->latest()->take(5)->get();
        $completedBookings = $user->bookings()->where('status', 'Completed')->count();

        return view('profile.customer.show', [
            'user' => $user,
            'bookings' => $bookings,
            'completedBookings' => $completedBookings,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        if ($user->role === 'provider') {
            $provider = Provider::where('user_id', $user->id)->first();
            $services = Service::all();

            return view('profile.provider.edit', [
                'user' => $user,
                'provider' => $provider,
                'services' => $services,
            ]);
        }

        return view('profile.customer.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Get validated data excluding 'role' field to prevent role modification
        $validatedData = $request->safe()->except(['role']);

        $user->fill($validatedData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // If the user is a provider, update provider-specific information
        if ($user->role === 'provider' && $request->has('business_name')) {
            $provider = Provider::where('user_id', $user->id)->first();

            if ($provider) {
                $provider->update([
                    'business_name' => $request->business_name,
                    'description' => $request->description,
                    'service_id' => $request->service_id,
                ]);
            }
        }

        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
