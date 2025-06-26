<?php 
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class BlogService
{
    protected string $apiKey;
    protected $newsApiKey;
    protected $NYTimesApiKey;
    protected string $baseUrl = 'https://www.googleapis.com/youtube/v3';

    public function __construct()
    {
        $this->apiKey        = config('services.youtube.key');
        $this->newsApiKey    = config('services.newsapi.key');
        $this->NYTimesApiKey = config('services.nytimes.key');
    }

    public function searchVideos(string $query, int $maxResults = 6): array
    {
        $response = Http::get("{$this->baseUrl}/search", [
            'part' => 'snippet',
            'q' => $query,
            'type' => 'video',
            'maxResults' => $maxResults,
            'key' => $this->apiKey,
        ]);

        if ($response->failed()) {
            return [];
        }

        return collect($response->json('items'))->map(function ($item) {
            return [
                'videoId' => $item['id']['videoId'],
                'title' => $item['snippet']['title'],
                'description' => $item['snippet']['description'],
                'thumbnail' => $item['snippet']['thumbnails']['medium']['url'],
            ];
        })->toArray();
    }

    public function fetchArticles($query)
    {
        $response = Http::get('https://newsapi.org/v2/everything', [
            'q' => $query,
            'apiKey' => $this->newsApiKey,
            'language' => 'en',
            'sortBy' => 'publishedAt',
        ]);

        if ($response->successful()) {
            return $response->json()['articles'];
        }

        return [];
    }

    public function fetchNYTArticles(string $query, int $page = 1): array
    {
        $cacheKey = "nyt_articles_{$query}_page_{$page}";
        
        return Cache::remember($cacheKey, now()->addHours(1), function () use ($query, $page) {
            $response = Http::get('https://api.nytimes.com/svc/search/v2/articlesearch.json', [
                'q' => $query,
                'sort' => 'newest',
                'api-key' => $this->NYTimesApiKey,
                'page' => $page - 1, // NYT API uses 0-based pagination
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['response']['docs']) && is_array($data['response']['docs'])) {
                    $articles = collect($data['response']['docs']);
                    return [
                        'articles' => $articles->take(10)->toArray(),
                        'total' => min($data['response']['metadata']['hits'], 100), // NYT API limits to 100 pages
                        'per_page' => 10,
                        'current_page' => $page
                    ];
                }
            }

            return [
                'articles' => [],
                'total' => 0,
                'per_page' => 10,
                'current_page' => 1
            ];
        });
    }

}