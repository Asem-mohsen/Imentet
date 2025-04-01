<?php 

namespace App\Services;

use App\Repositories\ContactRepository;

class ContactService
{
    public function __construct(protected ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function handleContactForm(array $data)
    {
        return $this->contactRepository->store($data);
    }
}