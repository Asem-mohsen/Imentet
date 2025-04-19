<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Services\CollectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    public function __construct(protected CollectionService $collectionService)
    {
        $this->collectionService = $collectionService;
    }

    public function gemCollections()
    {
        $categories = $this->collectionService->getCategoriesWithCollections(placeName: 'Grand Egyptian Museum', limit:8);
        return view('website.gem.collections.index' , get_defined_vars());
    }

    public function show(Collection $collection)
    {
        $collections = $this->collectionService->getCollections(placeName: 'Grand Egyptian Museum', limit:3);
        $collection = $this->collectionService->getCollection($collection->id);
        $adjacentCollections = $this->collectionService->getAdjacentCollections($collection->id, 'Grand Egyptian Museum');

         return view('website.gem.collections.show', [
            'collection' => $collection,
            'collections' => $collections,
            'prevCollection' => $adjacentCollections['prev'],
            'nextCollection' => $adjacentCollections['next'],
        ]);
    }

    public function showByCategory(Request $request, $slug)
    {
        $category = $this->collectionService->getCategoriesWithCollections(placeName: 'Grand Egyptian Museum', slug: $slug);

        if (!$category) {
            abort(404);
        }

        $categories = $this->collectionService->getCategories();

        $filteredCategoryId = $request->get('category_id');
        
        if ($filteredCategoryId && $filteredCategoryId != $category->id) {
            $category = $categories->firstWhere('id', $filteredCategoryId);
        }

        $collections = $category->collections()
            ->whereHas('places', function ($query) {
                $query->where('name->en', 'Grand Egyptian Museum');
            })
            ->paginate(6);

        $view = View::exists('website.gem.collections.categories.partials.' . Str::slug($category->name))
        ? 'website.gem.collections.categories.index'
        : 'website.gem.collections.categories.index';

        return view($view, compact('category', 'categories', 'collections'));
    }
}
