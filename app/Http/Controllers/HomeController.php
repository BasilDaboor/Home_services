<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with services and providers
     */
    public function index()
    {
        // Get all services for the service category section
        $services = Service::all();

        // Get top-rated providers for the popular business section
        $providers = Provider::with(['user', 'service'])
            ->orderBy('rating', 'desc')
            ->take(8)
            ->get();

        return view('home', compact('services', 'providers'));
    }

    /**
     * Search for providers based on query and/or service id
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $serviceId = $request->input('service_id');

        // Get all services for the service category section
        $services = Service::all();

        // Start the query builder for providers
        $providersQuery = Provider::with(['user', 'service']);

        // Filter by service if specified
        if ($serviceId) {
            $providersQuery->where('service_id', $serviceId);
        }

        // Filter by search query if provided
        if ($query) {
            $providersQuery->where(function ($q) use ($query) {
                $q->where('business_name', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    // Search in related user information
                    ->orWhereHas('user', function ($userQuery) use ($query) {
                        $userQuery->where('first_name', 'like', "%{$query}%")
                            ->orWhere('last_name', 'like', "%{$query}%")
                            ->orWhere('address', 'like', "%{$query}%");
                    });
            });
        }

        // Get the providers
        $providers = $providersQuery->orderBy('rating', 'desc')->paginate(12);

        // If it's an AJAX request, return JSON
        if ($request->ajax()) {
            return response()->json([
                'providers' => $providers
            ]);
        }

        // Otherwise return the search view
        return view('search', compact('services', 'providers', 'query', 'serviceId'));
    }
}
