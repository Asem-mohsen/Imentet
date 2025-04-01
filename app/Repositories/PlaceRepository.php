<?php 
namespace App\Repositories;

use App\Models\Place;

class PlaceRepository
{
    public function getAllPlaces()
    {
        return Place::all();
    }

}