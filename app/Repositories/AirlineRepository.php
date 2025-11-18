<?php

namespace App\Repositories;
use App\Interfaces\AirlineRepositoryInterface;

class AirlineRepository implements AirlineRepositoryInterface
{
    // Repository methods will be defined here
    public function getAllAirlines()
    {
        // Implementation to retrieve all airlines
        return Airline::all();
    }
}