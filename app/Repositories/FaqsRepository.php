<?php 
namespace App\Repositories;

use App\Models\{Faq, FaqCategory};

class FaqsRepository
{
    public function getFAQs()
    {
        return FaqCategory::whereHas('faqs', function ($query) {
            $query->where('is_shown', true);
        })
        ->with(['faqs' => function ($query) {
            $query->where('is_shown', true);
        }])
        ->get();
    }
}