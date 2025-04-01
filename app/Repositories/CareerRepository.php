<?php 
namespace App\Repositories;

use App\Models\{Career, CareerApplication};

class CareerRepository
{
    public function getAllCareers(?string $placeName = null)
    {
        $query = Career::when($placeName, function ($query) use ($placeName) {
            $query->whereHas('place', function ($query) use ($placeName) {
                $query->where('name->en', $placeName);
            });
        });
    
        return $query->get();
    }

    public function create(array $data)
    {
        return CareerApplication::create($data);
    }
}