<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
