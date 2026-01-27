<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trip extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'booking_id',
        'departure_date',
        'arrival_date',
        'arrival',
        'departure',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'departure_date' => 'date',
            'arrival_date' => 'date',
        ];
    }

    /**
     * Get the booking that owns the trip.
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}