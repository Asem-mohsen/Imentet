<?php 
namespace App\Services;

use App\Repositories\CareerRepository;
use Illuminate\Http\UploadedFile;

class CareerService
{
    public function __construct(protected CareerRepository $careerRepository )
    {
        $this->careerRepository = $careerRepository;
    }

    public function getCareers(?string $placeName = null)
    {
        $careers = $this->careerRepository->getAllCareers($placeName);
        
        return get_defined_vars();
    }

    public function submitApplication($validatedRequest, $user, ?UploadedFile $cvFile = null): void
    {
        $user->update([
            'first_name' => $validatedRequest['first_name'],
            'last_name'  => $validatedRequest['last_name'],
            'email'      => $validatedRequest['email'],
            'phone'      => $validatedRequest['phone'],
        ]);

        $application = $this->careerRepository->create([
            'user_id'      => $user->id,
            'career_id'    => $validatedRequest['career_id'],
            'cover_letter' => $validatedRequest['cover_letter'],
            'status'       => 'pending',
        ]);

        if ($cvFile) {
            $application->addMedia($cvFile)->toMediaCollection('cv');
        }
    }
}