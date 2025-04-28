<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Provider;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    /**
     * Display the provider dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $user = Auth::user();
        $provider = $user->provider;

        if (!$provider) {
            return redirect()->route('account.provider.profile.edit')
                ->with('warning', 'Please complete your provider profile first.');
        }

        $pendingBookings = Booking::where('provider_id', $provider->id)
            ->where('status', 'pending')
            ->with(['user', 'service'])
            ->get();

        $upcomingBookings = Booking::where('provider_id', $provider->id)
            ->where('status', 'confirmed')
            ->upcoming()
            ->with(['user', 'service'])
            ->take(5)
            ->get();

        $totalBookings = Booking::where('provider_id', $provider->id)->count();
        $completedBookings = Booking::where('provider_id', $provider->id)
            ->where('status', 'completed')
            ->count();

        return view('account.provider.dashboard', compact(
            'user',
            'provider',
            'pendingBookings',
            'upcomingBookings',
            'totalBookings',
            'completedBookings'
        ));
    }

    /**
     * Display provider bookings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function bookings(Request $request)
    {
        $user = Auth::user();
        $provider = $user->provider;

        if (!$provider) {
            return redirect()->route('account.provider.profile.edit')
                ->with('warning', 'Please complete your provider profile first.');
        }

        $status = $request->get('status', 'all');

        $query = Booking::where('provider_id', $provider->id)
            ->with(['user', 'service']);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $bookings = $query->orderBy('booking_date', 'desc')->paginate(10);

        return view('account.provider.bookings', compact('bookings', 'status'));
    }

    /**
     * Update booking status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBookingStatus(Request $request, Booking $booking)
    {
        $user = Auth::user();
        $provider = $user->provider;

        if ($booking->provider_id !== $provider->id) {
            return back()->with('error', 'You are not authorized to update this booking.');
        }

        $validated = $request->validate([
            'status' => 'required|in:confirmed,cancelled,completed',
        ]);

        $booking->update(['status' => $validated['status']]);

        return back()->with('success', 'Booking status updated successfully.');
    }

    /**
     * Show the provider profile edit form.
     *
     * @return \Illuminate\View\View
     */
    public function editProfile()
    {
        $user = Auth::user();
        $provider = $user->provider;
        $services = Service::all();

        return view('account.provider.profile', compact('user', 'provider', 'services'));
    }

    /**
     * Update the provider profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $userValidated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $providerValidated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'description' => 'required|string|max:1000',
        ]);

        // Update user details
        $user->update($userValidated);

        // Update or create provider details
        if ($user->provider) {
            $user->provider->update($providerValidated);
        } else {
            Provider::create([
                'user_id' => $user->id,
                'service_id' => $providerValidated['service_id'],
                'description' => $providerValidated['description'],
            ]);

            // Update user role to provider if it's not already
            if ($user->role !== 'provider') {
                $user->update(['role' => 'provider']);
            }
        }

        return back()->with('success', 'Profile updated successfully.');
    }
}
