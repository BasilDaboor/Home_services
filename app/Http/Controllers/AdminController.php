<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        $totalProviders = User::where('role', 'provider')->count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalBookings = Booking::count();

        $recentBookings = Booking::with(['user', 'provider.user']) // eager load relationships
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.home', compact(
            'totalProviders',
            'totalCustomers',
            'totalBookings',
            'recentBookings'
        ));
    }
}
