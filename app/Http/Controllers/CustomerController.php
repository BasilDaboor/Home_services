<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display the customer dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $user = Auth::user();
        $upcomingBookings = Booking::where('user_id', $user->id)
            ->upcoming()
            ->with(['provider.user', 'service'])
            ->take(5)
            ->get();

        $recentBookings = Booking::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->with(['provider.user', 'service'])
            ->take(5)
            ->get();

        return view('account.customer.dashboard', compact('user', 'upcomingBookings', 'recentBookings'));
    }

    /**
     * Display customer bookings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function bookings(Request $request)
    {
        $user = Auth::user();
        $status = $request->get('status', 'all');

        $query = Booking::where('user_id', $user->id)
            ->with(['provider.user', 'service']);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $bookings = $query->orderBy('booking_date', 'desc')->paginate(10);

        return view('account.customer.bookings', compact('bookings', 'status'));
    }
}
