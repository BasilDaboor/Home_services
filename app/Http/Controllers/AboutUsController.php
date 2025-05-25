<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutUsController extends Controller
{
    /**
     * Display the about us page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Get the top 3 rated providers
        $featuredProviders = Provider::with(['user', 'service'])
            ->orderBy('rating', 'desc')
            ->take(3)
            ->get();

        return view('aboutUs', [
            'featuredProviders' => $featuredProviders
        ]);
    }
}
