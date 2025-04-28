<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesPageController extends Controller
{
    /**
     * Display the services index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $services = Service::all();

        // Get the first category as default
        $defaultCategory = $services->first()->name ?? 'All Services';

        // Get providers for the default category
        $providers = Provider::whereHas('service', function ($query) use ($defaultCategory) {
            $query->where('name', $defaultCategory);
        })->with(['user', 'service'])->paginate(6);

        return view('services', [
            'services' => $services,
            'currentCategory' => $defaultCategory,
            'providers' => $providers
        ]);
    }

    /**
     * Display the services for a specific category.
     *
     * @param  string  $category
     * @return \Illuminate\View\View
     */
    public function category($category)
    {
        $services = Service::all();

        // Ensure the category exists
        $categoryExists = $services->where('name', $category)->count() > 0;

        if (!$categoryExists) {
            return redirect()->route('services.index');
        }

        // Get providers for the selected category
        $providers = Provider::whereHas('service', function ($query) use ($category) {
            $query->where('name', $category);
        })->with(['user', 'service'])->paginate(6);

        return view('services', [
            'services' => $services,
            'currentCategory' => $category,
            'providers' => $providers
        ]);
    }
}
