<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'country_code',
        'phone',
        'email',
        'passengers',
        'message',
        'booking_type',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'passengers' => 'integer',
        ];
    }

    /**
     * Get the trips for the booking.
     */
    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }
}