<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the services.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('dashboard.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.services.create');
    }

    /**
     * Store a newly created service in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        Service::create($validated);

        return redirect()->route('dashboard.services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified service.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('dashboard.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified service.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('dashboard.services.edit', compact('service'));
    }

    /**
     * Update the specified service in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $service->update($validated);

        return redirect()->route('dashboard.services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified service from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        // Check if service is being used by providers or bookings
        if ($service->provider()->count() > 0 || $service->bookings()->count() > 0) {
            return redirect()->route('dashboard.services.index')
                ->with('error', 'Cannot delete service as it is associated with providers or bookings.');
        }

        $service->delete();

        return redirect()->route('dashboard.services.index')
            ->with('success', 'Service deleted successfully.');
    }
}