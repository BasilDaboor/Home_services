<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application landing page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get all services for category display
        $services = Service::all();

        // Get popular providers with their users and services
        $popularProviders = Provider::with(['user', 'service'])
            ->orderBy('rating', 'desc')
            ->take(8)
            ->get();

        return view('home', compact('services', 'popularProviders'));
    }

    /**
     * Search for providers based on service or location
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search providers by service name or description
        $providers = Provider::with(['user', 'service'])
            ->whereHas('service', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            })
            ->orWhereHas('user', function ($q) use ($query) {
                $q->where('address', 'like', "%{$query}%");
            })
            ->orderBy('rating', 'desc')
            ->paginate(12);

        return view('search-results', compact('providers', 'query'));
    }

    /**
     * Display providers by service
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\View\View
     */
    public function serviceProviders(Service $service)
    {
        $providers = Provider::where('service_id', $service->id)
            ->with('user')
            ->orderBy('rating', 'desc')
            ->paginate(12);

        return view('service-providers', compact('service', 'providers'));
    }

    /**
     * Display provider details
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\View\View
     */
    public function providerDetails(Provider $provider)
    {
        $provider->load(['user', 'service']);

        // Get provider reviews
        $reviews = Review::where('provider_id', $provider->id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('provider-details', compact('provider', 'reviews'));
    }
}
