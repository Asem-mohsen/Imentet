<?php 
namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    public function store(array $data): Contact
    {
        return Contact::create($data);
    }
}