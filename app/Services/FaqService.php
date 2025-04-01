<?php 
namespace App\Services;

use App\Repositories\FaqsRepository;

class FaqService
{
    public function __construct(protected FaqsRepository $faqsRepository )
    {
        $this->faqsRepository = $faqsRepository;
    }

    public function getFaqs()
    {
        return $this->faqsRepository->getFAQs();
    }
}