<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use App\Services\BlogService;

class BlogController extends Controller
{
    public function __construct(protected BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function gemBlog()
    {
        $reels = $this->blogService->searchVideos('Grand Egyptian Museum');
        $articles = $this->blogService->fetchNYTArticles('Grand Egyptian Museum');
        
        return view('website.gem.blog', compact('reels', 'articles'));
    }

    public function pyramidsBlog()
    {
        $reels = $this->blogService->searchVideos('Pyramids');
        $articles = $this->blogService->fetchNYTArticles('Pyramids');

        return view('website.pyramids.blog', compact('reels', 'articles'));
    }
}
