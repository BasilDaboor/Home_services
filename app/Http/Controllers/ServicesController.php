<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('service-images', 'public');
            $validated['image'] = $imagePath;
        }

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }

            $imagePath = $request->file('image')->store('service-images', 'public');
            $validated['image'] = $imagePath;
        }

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
        if ($service->providers()->count() > 0 || $service->bookings()->count() > 0) {
            return redirect()->route('dashboard.services.index')
                ->with('error', 'Cannot delete service as it is associated with providers or bookings.');
        }

        // Delete image if exists
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('dashboard.services.index')
            ->with('success', 'Service deleted successfully.');
    }
}
