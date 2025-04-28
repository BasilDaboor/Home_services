<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Provider;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly created review in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'provider_id' => 'required|exists:providers,id',
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $booking = Booking::findOrFail($validated['booking_id']);

        // Verify the booking belongs to the user and is completed
        if ($booking->user_id !== $user->id || $booking->status !== 'completed') {
            return back()->with('error', 'You can only review completed bookings.');
        }

        // Check if user has already reviewed this booking
        $existingReview = Review::where('user_id', $user->id)
            ->where('provider_id', $validated['provider_id'])
            ->first();

        if ($existingReview) {
            // Update existing review
            $existingReview->update([
                'rating' => $validated['rating'],
                'comment' => $validated['comment'] ?? $existingReview->comment,
            ]);

            $message = 'Review updated successfully.';
        } else {
            // Create new review
            Review::create([
                'user_id' => $user->id,
                'provider_id' => $validated['provider_id'],
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
            ]);

            $message = 'Review submitted successfully.';
        }

        // Update provider's average rating
        $provider = Provider::findOrFail($validated['provider_id']);
        $avgRating = Review::where('provider_id', $provider->id)->avg('rating');
        $provider->update(['rating' => $avgRating]);

        return back()->with('success', $message);
    }
}
