<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Provider;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the bookings.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'provider', 'service']);

        // Filter by status if provided
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($query) use ($search) {
                    $query->where('first_name', 'like', "%{$search}%");
                })->orWhereHas('provider.user', function ($query) use ($search) {
                    $query->where('first_name', 'like', "%{$search}%");
                })->orWhereHas('service', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                })->orWhereHas('provider.user', function ($query) use ($search) {
                    $query->where('last_name', 'like', "%{$search}%");
                })->orWhereHas('user', function ($query) use ($search) {
                    $query->where('last_name', 'like', "%{$search}%");
                });
            });
        }

        $bookings = $query->orderBy('booking_date', 'desc')->paginate(10);
        $statuses = ['pending', 'confirmed', 'cancelled', 'completed'];

        return view('dashboard.bookings.index', compact('bookings', 'statuses'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create() {}

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'provider_id' => 'required|exists:providers,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after:now',
            'notes' => 'nullable|string',
        ]);

        // Check if user is authenticated and is a customer
        if (!Auth::check() || Auth::user()->role !== 'customer') {
            return redirect()->back()->with('error', 'Only customers can book services.');
        }

        // Create the booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'provider_id' => $validated['provider_id'],
            'service_id' => $validated['service_id'],
            'booking_date' => $validated['booking_date'],
            'status' => 'pending', // Default status
        ]);

        return redirect()->route('profile.show')->with('success', 'Booking created successfully. The provider will confirm your appointment.');
    }

    /**
     * Display the specified booking.
     */
    public function show(Booking $booking)
    {
        $booking->load(['user', 'provider', 'service']);
        return view('dashboard.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified booking.
     */
    public function edit(Booking $booking)
    {
        $users = User::all();
        $providers = Provider::all();
        $services = Service::all();
        $statuses = ['pending', 'confirmed', 'cancelled', 'completed'];

        return view('dashboard.bookings.edit', compact('booking', 'users', 'providers', 'services', 'statuses'));
    }

    /**
     * Update the specified booking in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'provider_id' => 'required|exists:providers,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $booking->update($validated);

        return redirect()->route('dashboard.bookings.index')
            ->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified booking from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('dashboard.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }






    // * Update the status of a booking
    // */
    public function updateStatus(Request $request, Booking $booking)
    {
        // Verify the booking belongs to the authenticated provider
        if (Auth::user()->role === 'provider' && Auth::user()->id === $booking->provider->user_id) {
            $request->validate([
                'status' => 'required|in:confirmed,completed,cancelled',
            ]);

            $booking->update([
                'status' => $request->status,
            ]);

            return redirect()->route('profile.show')->with('success', 'Booking status updated successfully.');
        }

        return redirect()->route('profile.show')->with('error', 'You are not authorized to update this booking.');
    }

    public function cancel(Booking $booking)
    {
        // Verify the booking belongs to the authenticated user
        if (Auth::id() !== $booking->user_id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Only allow cancelling pending bookings
        if (!in_array($booking->status, ['pending'])) {
            return redirect()->back()->with('error', 'This booking cannot be cancelled.');
        }

        $booking->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }
}
