<?php

namespace App\Repositories;

use App\Interfaces\AirportRepositoryInterface;
use App\Models\Airport;

class AirportRepository implements AirportRepositoryInterface
{
    // Repository methods will be defined here
    public function getAllAirports()
    {
        // Implementation to retrieve all Airports
        return Airport::all();
    }

    public function getAirportBySlug($slug)
    {
        // Implementation to retrieve an Airport by its slug
        return Airport::where('slug', $slug)->first();
    }

    public function getAirportByIataCode($iataCode)
    {
        // Implementation to retrieve an Airport by its IATA code
        return Airport::where('iata_code', $iataCode)->first();
    }
}
