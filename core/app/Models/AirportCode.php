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
        'iata_code',
        'city',
        'iso_country',
        'iso_region',
        'icao_code',
        'coordinates',
    ];
}