<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AirportCode extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'airport',
        'airport_type',
        'city',
        'country',
        'iata',
        'icao',
        'faa',
    ];
}