<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'provider_id',
        'service_id',
        'booking_date',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'booking_date' => 'datetime',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Scope a query to only include bookings with a specific status.
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include upcoming bookings.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('booking_date', '>=', now())
                    ->where('status', '!=', 'cancelled');
    }

    /**
     * Scope a query to only include past bookings.
     */
    public function scopePast($query)
    {
        return $query->where('booking_date', '<', now());
    }

    /**
     * Check if the booking is pending.
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if the booking is confirmed.
     */
    public function isConfirmed()
    {
        return $this->status === 'confirmed';
    }

    /**
     * Check if the booking is cancelled.
     */
    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    /**
     * Check if the booking is completed.
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }
}
