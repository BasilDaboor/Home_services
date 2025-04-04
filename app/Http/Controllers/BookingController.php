<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Provider;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

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
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($query) use ($search) {
                    $query->where('first_name', 'like', "%{$search}%");
                })->orWhereHas('provider.user', function($query) use ($search) {
                    $query->where('first_name', 'like', "%{$search}%");
                })->orWhereHas('service', function($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                })->orWhereHas('provider.user', function($query) use ($search) {
                    $query->where('last_name', 'like', "%{$search}%");
                })->orWhereHas('user', function($query) use ($search) {
                    $query->where('last_name', 'like', "%{$search}%");});
            });
        }
        
        $bookings = $query->orderBy('booking_date', 'desc')->paginate(10);
        $statuses = ['pending', 'confirmed', 'cancelled', 'completed'];
        
        return view('dashboard.bookings.index', compact('bookings', 'statuses'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create()
    {
        $users = User::all();
        $providers = Provider::all();
        $services = Service::all();
        $statuses = ['pending', 'confirmed', 'cancelled', 'completed'];
        
        return view('dashboard.bookings.create', compact('users', 'providers', 'services', 'statuses'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'provider_id' => 'required|exists:providers,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        Booking::create($validated);

        return redirect()->route('dashboard.bookings.index')
            ->with('success', 'Booking created successfully.');
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
}