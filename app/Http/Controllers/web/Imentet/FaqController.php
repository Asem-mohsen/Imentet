<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use App\Services\FaqService;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function __construct(protected FaqService $faqService)
    {
        // 
    }

    public function gemFaqs()
    {
        $categories = $this->faqService->getFaqs();
        return view('website.gem.faqs', compact('categories'));
    }

    public function pyramidsFaqs()
    {
        $categories = $this->faqService->getFaqs();
        return view('website.gem.faqs', compact('categories'));
    }
}
